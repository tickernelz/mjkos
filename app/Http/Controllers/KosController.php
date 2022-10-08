<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::first();
        return view('backend.kos.index', compact('kos'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama'         => 'required',
            'email'        => 'required',
            'telp'         => 'required',
            'alamat'       => 'required',
            'deskripsi'    => 'required',
        ]);
        if ($request->cover) {
            $kos = Kos::whereid($id)->first();
            if (file_exists(public_path() . '/images/' . $kos->cover)) {
                unlink(public_path() . '/images/' . $kos->cover);
            }
            $cover = $request->cover;
            $new_foto = 'hero-bg' . "." . $cover->getClientOriginalExtension();
            $destination = 'images/';
            $cover->move($destination, $new_foto);
            Kos::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'cover' => $new_foto
            ]);
        } else {
            Kos::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return redirect()->route('kos.index')->with('success', 'Informasi Kos Berhasil diubah!.');
    }
}
