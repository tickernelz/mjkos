<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::whereBetween('status', [1, 3])->get();
        return view('backend.transaksi.booking.index', compact('transaksi'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $transaksi = Transaksi::whereId($id)->first();
        return view('backend.transaksi.booking.detail', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        //
    }

    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function statusUpdate($id, $status)
    {
        $kos_id = Transaksi::whereId($id)->value('kos_id');
        if ($status == 2) {
            Transaksi::whereId($id)->update([
                'status' => 2
            ]);
            return redirect()->back()->with('success', 'Pengajuan Berhasil disetujui!.');
        } elseif ($status == -1) {
            Transaksi::whereId($id)->update([
                'status' => -1
            ]);
            return redirect()->back()->with('success', 'Pengajuan Berhasil ditolak!.');
        } elseif ($status == 4) {
            Transaksi::whereId($id)->update([
                'status' => 4
            ]);
            Kos::whereId($kos_id)->update([
                'jumlah_transaksi' => + 1
            ]);
            return redirect()->back()->with('success', 'Konfirmasi Pembayaran Berhasil dilakukan!.');
        } elseif ($status == 5) {
            Transaksi::whereId($id)->update([
                'status' => 5
            ]);
            return redirect()->back()->with('success', 'Pengajuan Perpanjang Berhasil dilakukan!.');
        } elseif ($status == 6) {
            Transaksi::whereId($id)->update([
                'status' => 6
            ]);
            Kos::whereId($kos_id)->update([
                'jumlah_transaksi' => + 1
            ]);
            return redirect()->back()->with('success', 'Pengajuan Perpanjang Berhasil setujui!.');
        } elseif ($status == 8) {
            $tr = Transaksi::whereId($id)->first();
            $mulai = $tr->tgl_selesai;
            $durasi = "+" . $tr->durasi . "" . "month";
            $selesai = date('Y-m-d', strtotime($durasi, strtotime($mulai)));
            Transaksi::whereId($id)->update([
                'status' => 8,
                'tgl_mulai' => $mulai,
                'tgl_selesai' => $selesai
            ]);
            Kos::whereId($kos_id)->update([
                'jumlah_transaksi' => + 1
            ]);
            return redirect()->back()->with('success', 'Pengajuan Perpanjang Berhasil setujui!.');
        }
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    public function daftarPengguna()
    {
        $pengguna = Transaksi::where('status', '>=', 4)->get();
        return view('backend.transaksi.pengguna.index', compact('pengguna'));
    }
}
