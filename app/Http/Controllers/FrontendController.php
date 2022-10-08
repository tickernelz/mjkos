<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\Peraturan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function detailKamar($id)
    {
        $kamar = Kamar::whereId($id)->with('foto')->first();
        if (Auth::check()) {
            $transaksi = Transaksi::where('kamar_id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
        } else {
            $transaksi = Transaksi::where('kamar_id', $id)
                ->first();
        }

        $fasilitas = Fasilitas::all();
        $peraturan = Peraturan::all();
        return view('frontend.detail-kamar', compact('kamar', 'fasilitas', 'peraturan', 'transaksi'));
    }

    public function formPengajuan($id, Request $request)
    {
        // id = Kamar id
        $transaksi = Transaksi::where('kamar_id', $id)
            ->where('user_id', Auth::user()->id)
            ->where('status', '!=', 0)
            ->first();
        $kamar = Kamar::whereId($id)->first();
        $biaya = $request->biaya;
        $tgl_mulai = $request->date;
        $durasi = $request->durasi;
        return view('frontend.pengajuan', compact('transaksi', 'kamar', 'biaya', 'tgl_mulai', 'durasi'));
    }

    public function updatePengajuan($id, Request $request)
    {
        $transaksi = Transaksi::where('user_id', Auth::user()->id)->whereBetween('status', [1, 4])->get();
        if ($transaksi->IsNotEmpty()) {
            return redirect()->back()->with('error', 'Anda tidak boleh meminjam lebih dari 1 kamar.');
        }

        $durasi = "+" . $request->durasi . "" . "month";
        $tgl_end = date('Y-m-d', strtotime($durasi, strtotime($request->mulai)));
        $kode = "ATJ" . "-" . date('dmY') . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        $favorit =  Transaksi::where('kamar_id', $id)
            ->where('status', 0)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($favorit) {
            Transaksi::whereId($favorit->id)->update([
                'kode'              => $kode,
                'durasi'            => $request->durasi,
                'tgl_mulai'         => $request->mulai,
                'tgl_selesai'       => $tgl_end,
                'status'            => 1,
                'biaya'             => $request->biaya
            ]);
        } else {
            Transaksi::create([
                'kode'              => $kode,
                'user_id'           => Auth::user()->id,
                'kamar_id'          => $id,
                'durasi'            => $request->durasi,
                'tgl_mulai'         => $request->mulai,
                'tgl_selesai'       => $tgl_end,
                'status'            => 1,
                'biaya'             => $request->biaya
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
        $kmr = 'no-kamar-' . $transaksi->kamar->pintu_id;
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
        $kamar_id = Transaksi::whereId($request->delete_id)->value('kamar_id');
        Kamar::whereId($kamar_id)->update([
            'status' => 0
        ]);
        Transaksi::whereId($request->delete_id)->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus!.');
    }

    public function addFavorit($id)
    {
        Transaksi::create([
            'status'            => 0,
            'user_id'           => Auth::user()->id,
            'kamar_id'          => $id,
        ]);
        return redirect()->back()->with('success', 'Berhasil ditambah ke dalam favorit.');
    }
}
