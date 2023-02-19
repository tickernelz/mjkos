<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kos;
use App\Models\Peraturan;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function detailKos($id)
    {
        $kos = Kos::whereId($id)->with('foto')->first();
        if (Auth::check()) {
            $transaksi = Transaksi::where('kos_id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
        } else {
            $transaksi = Transaksi::where('kos_id', $id)
                ->first();
        }

        $fasilitas = Fasilitas::where('kos_id', $id)->get();
        $peraturan = Peraturan::where('kos_id', $id)->get();
        $reviews = Review::where('kos_id', $id)->paginate(3);
        return view('frontend.detail-kos', compact('kos', 'fasilitas', 'peraturan', 'transaksi', 'reviews'));
    }

    public function cariKosProses($lat, $lng, $radius = 40)
    {
        $latitude = $lat;
        $longitude = $lng;
        $data = DB::table('kos')
            ->select(DB::raw('*, ( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( address_latitude ) ) * cos( radians( address_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( address_latitude ) ) ) ) AS distance'))
            ->get();
        # Remove kos that are not in the radius
        $data = $data->filter(function ($value, $key) use ($radius) {
            return $value->distance <= $radius;
        });
        return $data->sortBy('distance');
    }

    public function cariKos(Request $request)
    {
        $lat = $request->latitude;
        $lng = $request->longitude;
        $kos = Kos::where('status', 0);
        $alamat = null;
        $jarak = null;
        $harga_min = $kos->min('harga');
        $harga_max = $kos->max('harga');
        // Filter Initial
        $fil_harga_min = $request->fil_harga_min ?? $harga_min;
        $fil_harga_max = $request->fil_harga_max ?? $harga_max;
        $paling_populer = $request->fil_populer ?? "off";
        if ($request->has('latitude') && $request->has('longitude')) {
            $latitude = $lat;
            $longitude = $lng;
            if ($latitude == null || $longitude == null) {
                $kos_nearby = $kos->get();
            } else {
                $kos_nearby = $this->cariKosProses($latitude, $longitude);
            }
            $kos = $kos->whereIn('id', $kos_nearby->pluck('id'));
            $jarak = $kos_nearby->pluck('distance', 'id');
        }
        if ($request->alamat != null) {
            $alamat = $request->alamat;
        }

        $kos = $kos
            ->where('tampil', 1)
            ->where('verifikasi', 'sudah')
            ->where('harga', '>=', $fil_harga_min)
            ->where('harga', '<=', $fil_harga_max);

        // Filter
        if ($paling_populer == "on") {
            $kos = $kos->orderBy('jumlah_transaksi', 'desc');
        }
        $kos = $kos->paginate(10);

        // Save Sessions
        $request->session()->put('lat', $lat);
        $request->session()->put('lng', $lng);
        $request->session()->put('alamat', $alamat);
        $request->session()->put('jarak', $jarak);
        $request->session()->put('fil_harga_min', $fil_harga_min);
        $request->session()->put('fil_harga_max', $fil_harga_max);
        $request->session()->put('fil_populer', $paling_populer);

        return view('frontend.daftar-kos', compact('kos', 'jarak', 'alamat', 'harga_min', 'harga_max'));
    }

    public function formPengajuan($id, Request $request)
    {
        // id = Kos id
        $transaksi = Transaksi::where('kos_id', $id)
            ->where('user_id', Auth::user()->id)
            ->where('status', '!=', 0)
            ->first();
        $kos = Kos::whereId($id)->first();
        $pemilik = $kos->user;
        $metode_pembayaran = $pemilik->RekeningPembayaran;
        $biaya = $request->biaya;
        $tgl_mulai = $request->date;
        $durasi = $request->durasi;
        return view('frontend.pengajuan', compact('transaksi', 'kos', 'biaya', 'tgl_mulai', 'durasi', 'metode_pembayaran'));
    }

    public function updatePengajuan($id, Request $request)
    {
        $durasi = "+" . $request->durasi . "" . "month";
        $tgl_end = date('Y-m-d', strtotime($durasi, strtotime($request->mulai)));
        $kode = "ATJ" . "-" . date('dmY') . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        $favorit = Transaksi::where('kos_id', $id)
            ->where('status', 0)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($favorit) {
            Transaksi::whereId($favorit->id)->update([
                'kode' => $kode,
                'durasi' => $request->durasi,
                'tgl_mulai' => $request->mulai,
                'tgl_selesai' => $tgl_end,
                'status' => 1,
                'biaya' => $request->biaya
            ]);
        } else {
            Transaksi::create([
                'kode' => $kode,
                'user_id' => Auth::user()->id,
                'kos_id' => $id,
                'durasi' => $request->durasi,
                'tgl_mulai' => $request->mulai,
                'tgl_selesai' => $tgl_end,
                'status' => 1,
                'biaya' => $request->biaya
            ]);
        }

        return redirect()->route('form.pengajuan', $id)->with('success', 'Pengajuan Anda berhasil dilakukan.');
    }


    public function updatePembayaran(Request $request)
    {
        $id = $request->id;
        $transaksi = Transaksi::whereId($id)->first();
        if ($request->status == 1) {
            if (file_exists(public_path() . '/images/bukti' . $transaksi->foto_pembayaran)) {
                unlink(public_path() . '/images/bukti' . $transaksi->foto_pembayaran);
            }
        }

        $bukti = $request->bukti;
        $kmr = 'no-kos-' . $transaksi->kos->pintu_id;
        $new_bukti = 'Pembayaran' . "-" . date('Y-m-d') . "-" . Auth::user()->name . "-" . $kmr . "." . $bukti->getClientOriginalExtension();
        $destination = 'images/bukti';
        $bukti->move($destination, $new_bukti);

        if ($request->status == 1) {
            Transaksi::whereId($id)->update([
                'status' => 7,
                'foto_pembayaran' => $new_bukti
            ]);
        } else {
            Transaksi::whereId($id)->update([
                'status' => 3,
                'foto_pembayaran' => $new_bukti
            ]);
        }
        return redirect()->back()->with('success', 'Bukti pembayaran Anda berhasil dikirim.');
    }

    public function transaksiSaya()
    {
        $user = Auth::user()->id;
        $transaksi = Transaksi::where('status', '!=', 0)->where('user_id', $user)->get();
        return view('frontend.transaksi', compact('transaksi'));
    }


    public function transaksiDestroy(Request $request)
    {
        $kos_id = Transaksi::whereId($request->delete_id)->value('kos_id');
        Kos::whereId($kos_id)->update([
            'status' => 0
        ]);
        Transaksi::whereId($request->delete_id)->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus!.');
    }

    public function addFavorit($id)
    {
        Transaksi::create([
            'status' => 0,
            'user_id' => Auth::user()->id,
            'kos_id' => $id,
        ]);
        return redirect()->back()->with('success', 'Berhasil ditambah ke dalam favorit.');
    }

    public function checkDokumen()
    {
        $user_id = Auth::user()->id;
        $user = User::whereId($user_id)->first();
        // Check foto_ktp and foto_kk not null
        $kk = $user->foto_kk;
        $ktp = $user->foto_ktp;
        if ($kk == null || $ktp == null) {
            return response()->json(['status' => 'error']);
        }
        return response()->json(['status' => 'success']);
    }
}
