<?php

use App\Http\Controllers\{DashboardController,
    FasilitasController,
    FrontendController,
    KosController,
    MetodePembayaransController,
    PersetujuanKosController,
    RekeningPembayaranController,
    PeraturanController,
    ReviewsController,
    TransaksiController,
    UserController
};
use App\Models\{Foto, Kos, Pengaturan, Transaksi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/tracking', function (Request $request) {
    $kode = $request->kode;
    $tracking = Transaksi::where('kode', $kode)->whereBetween('status', [1, 4])->value('status');

    return response()->json([
        'output' => $tracking
    ]);
})->name('tracking');

Route::get('/daftar', [FrontendController::class, 'cariKos'])->name('daftar');
Route::get('/daftar/cari', [FrontendController::class, 'cariKos'])->name('cari.kos');
Route::get('/detail/kos/{id}', [FrontendController::class, 'detailKos'])->name('detail.kos');

Route::get('/status/{id}/{status}', [TransaksiController::class, 'statusUpdate'])->name('transaksi.status');

Route::get('/cetak/bukti/{id}', [FrontendController::class, 'cetakBukti'])->name('cetak.bukti');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::post('/transaksi-saya/delete', [FrontendController::class, 'transaksiDestroy'])->name('destroy.transaksi');

    Route::group(['middleware' => ['role:pemilik|admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');

        // Kos Alasan Penolakan
        Route::get('/kos/alasan/penolakan', [KosController::class, 'getKosAlasan'])->name('kos.alasan');

        // Pengguna
        Route::resource('pengguna', UserController::class);
        Route::get('/aktif/pengguna/{user_id}/{aktif}', [UserController::class, 'updateaktif'])->name('pengguna.aktif');
        Route::post('/reset/password', [UserController::class, 'reset'])->name('pengguna.reset');

        // Kos
        Route::resource('kos', KosController::class);

        // Metode Pembayaran
        Route::resource('metode_pembayaran', MetodePembayaransController::class);

        // Metode Pembayaran Pemilik
        Route::resource('rekening_pembayaran', RekeningPembayaranController::class);

        // Persetujuan Kos
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/persetujuan_kos', [PersetujuanKosController::class, 'index'])->name('persetujuan_kos.index');
            Route::get('/persetujuan_kos/{id}', [PersetujuanKosController::class, 'show'])->name('persetujuan_kos.show');
            Route::put('/persetujuan_kos/{id}', [PersetujuanKosController::class, 'update'])->name('persetujuan_kos.update');
        });

        // Fasilitas
        Route::get('/kos/{kos_id}/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
        Route::get('/kos/{kos_id}/fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
        Route::post('/kos/{kos_id}/fasilitas/store', [FasilitasController::class, 'store'])->name('fasilitas.store');
        Route::get('/kos/{kos_id}/fasilitas/edit/{fas_id}', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
        Route::put('/kos/{kos_id}/fasilitas/update/{fas_id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
        Route::delete('/kos/{kos_id}/fasilitas/delete/{fas_id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

        // Peraturan
        Route::get('/kos/{kos_id}/peraturan', [PeraturanController::class, 'index'])->name('peraturan.index');
        Route::get('/kos/{kos_id}/peraturan/create', [PeraturanController::class, 'create'])->name('peraturan.create');
        Route::post('/kos/{kos_id}/peraturan/store', [PeraturanController::class, 'store'])->name('peraturan.store');
        Route::get('/kos/{kos_id}/peraturan/edit/{per_id}', [PeraturanController::class, 'edit'])->name('peraturan.edit');
        Route::put('/kos/{kos_id}/peraturan/update/{per_id}', [PeraturanController::class, 'update'])->name('peraturan.update');
        Route::delete('/kos/{kos_id}/peraturan/delete/{per_id}', [PeraturanController::class, 'destroy'])->name('peraturan.destroy');

        // Transaksi
        Route::resource('transaksi', TransaksiController::class);
        Route::get('/daftar/pengguna', [TransaksiController::class, 'daftarPengguna'])->name('pengguna.kos');

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
            Route::post('/update/dokumen', [DashboardController::class, 'updateDokumen'])->name('dokumen');
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
        Route::get('/check/dokumen', [FrontendController::class, 'checkDokumen'])->name('check.dokumen');
        Route::post('/review/store', [ReviewsController::class, 'store'])->name('review.store');
    });
});
