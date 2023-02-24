<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Foto;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::where('user_id', auth()->user()->id)->get();
        return view('backend.kos.index', compact('kos'));
    }

    public function show($id)
    {
        $kos = Kos::whereId($id)->first();
        $fasilitas = Fasilitas::where('kos_id', $kos->id)->get();
        return view('backend.kos.show', compact('kos', 'fasilitas'));
    }

    public function create()
    {
        return view('backend.kos.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'address_address' => 'required',
            'deskripsi' => 'required',
            'luas' => 'required',
            'lebar' => 'required',
            'tampil' => 'required',
            'jumlah_kamar' => 'required',
            'status' => 'required',
            'cover' => 'required',
            'multiple' => 'required',
            'surat_kos' => 'required',
        ]);
        $nama = $request->nama;
        $ukuran = $request->luas . " X " . $request->lebar . ' ' . "meter";
        $cover = $request->cover;
        $new_cover = time() . '_' . Auth::user()->name . "-" . $nama . "." . $cover->getClientOriginalExtension();
        $dest_cover = 'images/kos/';
        $conv_harga = str_replace(',', '', $request->harga);
        $surat_kos = $request->surat_kos;
        $new_surat_kos = time() . '_' . Auth::user()->name . "-" . $nama . "." . $surat_kos->getClientOriginalExtension();
        $dest_surat_kos = 'surat_kos/';

        $kos = Kos::create([
            'user_id' => auth()->user()->id,
            'nama' => $nama,
            'alamat' => $request->address_address,
            'address_latitude' => $request->address_latitude,
            'address_longitude' => $request->address_longitude,
            'cover' => $new_cover,
            'deskripsi' => $request->deskripsi,
            'jumlah_kamar' => $request->jumlah_kamar,
            'ukuran' => $ukuran,
            'tampil' => $request->tampil,
            'status' => $request->status,
            'harga' => $conv_harga,
            'surat_kos' => $new_surat_kos,
            'verifikasi' => 'proses',
        ]);

        if ($kos) {
            $cover->move($dest_cover, $new_cover);
            $surat_kos->move($dest_surat_kos, $new_surat_kos);
            foreach ($request->multiple as $key => $value) {
                $multiple_foto = $key . '_' . time() . '_' . Auth::user()->name . "-" . $nama . "." . $value->getClientOriginalExtension();
                $dest_multiple_foto = 'images/kos/multiple';
                $value->move($dest_multiple_foto, $multiple_foto);
                Foto::create([
                    'kos_id' => $kos->id,
                    'nama' => $multiple_foto,
                ]);
            }
        }

        return redirect()->route('kos.index')->with('success', 'Kos Berhasil ditambah!.');
    }

    public function edit($id)
    {
        $kos = Kos::whereId($id)->first();
        return view('backend.kos.edit', compact('kos'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
            'deskripsi' => 'required',
            'jumlah_kamar' => 'required',
            'jumlah_kamar_terisi' => 'required',
            'ukuran' => 'required',
            'tampil' => 'required',
            'status' => 'required',
            'harga' => 'required',
        ]);

        $kosData = array_merge($validatedData, [
            'nama' => $request->nama,
            'alamat' => $request->address_address,
            'address_latitude' => $request->address_latitude,
            'address_longitude' => $request->address_longitude,
            'deskripsi' => $request->deskripsi,
            'jumlah_kamar' => $request->jumlah_kamar,
            'jumlah_kamar_terisi' => $request->jumlah_kamar_terisi,
            'ukuran' => $request->ukuran,
            'tampil' => $request->tampil,
            'status' => $request->status,
            'harga' => str_replace(',', '', $request->harga),
        ]);

        $kos = Kos::findOrFail($id);
        $is_ulang = $request->submit_btn == 'ulang';

        if ($request->has('cover')) {
            if ($kos->cover && file_exists(public_path() . '/images/kos' . $kos->cover)) {
                unlink(public_path() . '/images/kos' . $kos->cover);
            }

            $cover = $request->cover;
            $new_cover = time() . '_' . Auth::user()->name . "-" . $kosData['nama'] . "." . $cover->getClientOriginalExtension();
            $dest_cover = 'images/kos/';

            $kosData['cover'] = $new_cover;

            Kos::whereId($id)->update($kosData);
            $cover->move($dest_cover, $new_cover);
        }

        if ($request->has('multiple')) {
            foreach ($request->multiple as $key => $value) {
                $multiple_foto = $key . '_' . time() . '_' . Auth::user()->name . "-" . $kosData['nama'] . "." . $value->getClientOriginalExtension();
                $dest_multiple_foto = 'images/kos/multiple';
                $value->move($dest_multiple_foto, $multiple_foto);
                Foto::create([
                    'kos_id' => $id,
                    'nama' => $multiple_foto,
                ]);
            }
        }

        if ($request->has('surat_kos') && $is_ulang) {
            if ($kos->surat_kos && file_exists(public_path() . '/surat_kos' . $kos->surat_kos)) {
                unlink(public_path() . '/surat_kos' . $kos->surat_kos);
            }

            $surat_kos = $request->surat_kos;
            $new_surat_kos = time() . '_' . Auth::user()->name . "-" . $kosData['nama'] . "." . $surat_kos->getClientOriginalExtension();
            $dest_surat_kos = 'surat_kos/';

            $kosData['surat_kos'] = $new_surat_kos;
            $kosData['verifikasi'] = 'proses';

            Kos::whereId($id)->update($kosData);
            $surat_kos->move($dest_surat_kos, $new_surat_kos);
        }

        $kos->update($kosData);

        return redirect()->route('kos.index')->with('success', 'Informasi Kos Berhasil diubah!.');
    }

    public function getKosAlasan(Request $request)
    {
        $id = $request->id;
        $kos = Kos::whereId($id)->first();
        $alasan = $kos->alasan_tolak;

        # Return string alasannya
        return response()->json($alasan);
    }
}
