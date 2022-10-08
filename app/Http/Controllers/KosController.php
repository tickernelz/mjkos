<?php

namespace App\Http\Controllers;

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
            'status' => 'required',
            'cover' => 'required',
            'multiple' => 'required',
        ]);

        $ukuran = $request->luas . " X " . $request->lebar . ' ' . "meter";

        $cover = $request->cover;
        $new_cover = time() . '_' . Auth::user()->name . "." . $cover->getClientOriginalExtension();
        $destination = 'images/kos/';
        $cover->move($destination, $new_cover);

        $kos = Kos::create([
            'user_id' => auth()->user()->id,
            'nama' => $request->nama,
            'alamat' => $request->address_address,
            'address_latitude' => $request->address_latitude,
            'address_longitude' => $request->address_longitude,
            'cover' => $new_cover,
            'deskripsi' => $request->deskripsi,
            'ukuran' => $ukuran,
            'tampil' => $request->tampil,
            'status' => $request->status,
            'harga' => $request->harga,
        ]);

        foreach ($request->multiple as $key => $value) {
            $multiple_foto = $key . '_' . time() . '_' . Auth::user()->name . "." . $value->getClientOriginalExtension();
            $destination = 'images/kos/multiple';
            $value->move($destination, $multiple_foto);
            Foto::create([
                'kos_id' => $kos->id,
                'nama' => $multiple_foto,
            ]);
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
        $request->validate([
            'nama' => 'required',
            'address_address' => 'required',
            'deskripsi' => 'required',
            'ukuran' => 'required',
            'tampil' => 'required',
            'status' => 'required',
            'harga' => 'required',
        ]);

        if ($request->multiple) {
            foreach ($request->multiple as $key => $value) {
                $multiple_foto = $key . '_' . time() . '_' . Auth::user()->name . "." . $value->getClientOriginalExtension();
                $destination = 'images/kos/multiple';
                $value->move($destination, $multiple_foto);
                Foto::create([
                    'kos_id' => $id,
                    'nama' => $multiple_foto,
                ]);
            }
        }


        if ($request->cover) {
            $kos = Kos::whereId($id)->first();
            if ($request->status == 1) {
                if (file_exists(public_path() . '/images/kos' . $kos->cover)) {
                    unlink(public_path() . '/images/kos' . $kos->cover);
                }
            }
            $cover = $request->cover;
            $new_cover = time() . '_' . Auth::user()->name . "." . $cover->getClientOriginalExtension();
            $destination = 'images/kos/';
            $cover->move($destination, $new_cover);
            Kos::whereId($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->address_address,
                'address_latitude' => $request->address_latitude,
                'address_longitude' => $request->address_longitude,
                'cover' => $new_cover,
                'deskripsi' => $request->deskripsi,
                'ukuran' => $request->ukuran,
                'tampil' => $request->tampil,
                'status' => $request->status,
                'harga' => $request->harga,
            ]);
        } else {
            Kos::whereId($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->address_address,
                'address_latitude' => $request->address_latitude,
                'address_longitude' => $request->address_longitude,
                'deskripsi' => $request->deskripsi,
                'ukuran' => $request->ukuran,
                'tampil' => $request->tampil,
                'status' => $request->status,
                'harga' => $request->harga,
            ]);
        }

        return redirect()->route('kos.index')->with('success', 'Informasi Kos Berhasil diubah!.');
    }
}
