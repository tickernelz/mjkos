<?php

use App\Http\Controllers\{
    DashboardController,
    FasilitasController,
    FrontendController,
    KamarController,
    KosController,
    PeraturanController,
    PintuController,
    TransaksiController,
    UserController
};
use App\Models\{
    Foto,
    Kamar,
    Kos,
    Transaksi
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Route
};

Route::get('/', function () {
    $kos = Kos::first();
    $kamar = Kamar::where('status', 0)->where('tampil', 1)->take(4)->get();
    return view('frontend.home', compact('kos', 'kamar'));
});

Route::get('/tracking', function (Request $request) {
    $kode = $request->kode;
    $tracking = Transaksi::where('kode', $kode)->whereBetween('status', [1, 4])->value('status');

    return response()->json([
        'output' => $tracking
    ]);
})->name('tracking');

Route::get('/daftar', function () {
    if (Auth::check()) {
        $cek = Transaksi::where('user_id', Auth::user()->id)
            ->where('status', '>', 0)
            ->pluck('kamar_id');
        $kamar = Kamar::where('status', 0)
            ->whereNotIn('id', $cek)
            ->where('tampil', 1)
            ->paginate(10);
    } else {
        $kamar = Kamar::where('status', 0)
            ->where('tampil', 1)
            ->paginate(10);
    }

    return view('frontend.daftar-kamar', compact('kamar'));
});
Route::get('/detail/kamar/{id}', [FrontendController::class, 'detailKamar'])->name('detail.kamar');


Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::post('/transaksi-saya/delete', [FrontendController::class, 'transaksiDestroy'])->name('destroy.transaksi');

    Route::group(['middleware' => ['role:pemilik|admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');

        // Pengguna
        Route::resource('pengguna', UserController::class);
        Route::get('/aktif/pengguna/{user_id}/{aktif}', [UserController::class, 'updateaktif'])->name('pengguna.aktif');
        Route::post('/reset/password', [UserController::class, 'reset'])->name('pengguna.reset');


        // Fasilitas
        Route::resource('fasilitas', FasilitasController::class);

        // Peraturan
        Route::resource('peraturan', PeraturanController::class);

        // Kos
        Route::resource('kos', KosController::class);

        // Kamar
        Route::resource('kamar', KamarController::class);

        // Pintu
        Route::resource('pintu', PintuController::class);

        // Transaksi
        Route::resource('transaksi', TransaksiController::class);
        Route::get('/status/{id}/{status}', [TransaksiController::class, 'statusUpdate'])->name('transaksi.status');
        Route::get('/daftar/pengguna', [TransaksiController::class, 'daftarPengguna'])->name('pengguna.kamar');

        Route::post('/foto/delete/{id}', function ($id) {
            Foto::whereId($id)->delete();
            return redirect()->back();
        })->name('destroy.foto');
    });


    Route::group(['middleware' => ['role:pengunjung']], function () {

        // Profile Routes
        Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
            Route::get('/', [DashboardController::class, 'profile'])->name('detail');
            Route::post('/update', [DashboardController::class, 'updateProfile'])->name('update');
            Route::post('/update/ktm', [DashboardController::class, 'updateKTM'])->name('ktm');
            Route::post('/update/foto', [DashboardController::class, 'updateFoto'])->name('foto');
            Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
        });

        Route::get('/add-favorit/{id}', [FrontendController::class, 'addFavorit'])->name('favorit.add');
        Route::get('/form/pengajuan/{id}', [FrontendController::class, 'formPengajuan'])->name('form.pengajuan');
        Route::post('/update/pengajuan/{id}', [FrontendController::class, 'updatePengajuan'])->name('update.pengajuan');
        Route::post('/update/pembayaran', [FrontendController::class, 'updatePembayaran'])->name('update.pembayaran');
        Route::get('/transaksi-saya', [FrontendController::class, 'transaksiSaya'])->name('transaksi.saya');
        Route::get('/favorit', function () {
            $transaksi = Transaksi::where('status', 0)->where('user_id', Auth::user()->id)->paginate(10);
            return view('frontend.favorit', compact('transaksi'));
        });
    });
});
