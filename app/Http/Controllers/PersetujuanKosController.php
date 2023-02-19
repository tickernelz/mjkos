<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class PersetujuanKosController extends Controller
{
    public function index()
    {
        $kos = Kos::whereIn('verifikasi', ['proses', 'ditolak', 'sudah'])->get();
        return view('backend.persetujuanKos.index', compact('kos'));
    }

    public function show($id)
    {
        $kos = Kos::find($id);
        return view('backend.persetujuanKos.detail', compact('kos'));
    }

    public function update(Request $request, $id)
    {
        $kos = Kos::find($id);
        $kos->verifikasi = $request->verifikasi;
        if ($request->verifikasi == 'ditolak') {
            $kos->alasan_tolak = $request->alasan;
        }
        $kos = $kos->save();
        if ($kos) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengubah status persetujuan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status persetujuan'
            ]);
        }
    }
}
