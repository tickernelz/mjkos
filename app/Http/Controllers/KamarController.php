<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kamar;
use App\Models\Pintu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = Kamar::all();
        return view('backend.kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kamar = Kamar::pluck('pintu_id');
        $pintu = Pintu::whereNotIn('id', $kamar)->get();
        return view('backend.kamar.add', compact('pintu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pintu_id'          => 'required',
            'luas'              => 'required',
            'lebar'             => 'required',
            'cover'              => 'required',
            'multiple'              => 'required',
            'deskripsi'         => 'required',
            'tampil'            => 'required',
            'harga'             => 'required',
            'status'             => 'required',
        ]);

        // Kamar kamar
        $pintu = $request->pintu_id;
        $kamarId = Kamar::max('id') + 1;
        foreach ($request->multiple as $key => $value) {
            $multiple_foto = $key . '_No' . " " . $pintu . "." . Auth::user()->name . "." . $value->getClientOriginalExtension();
            $destination = 'images/kamar/multiple';
            $value->move($destination, $multiple_foto);
            Foto::create([
                'kamar_id'  => $kamarId,
                'nama'      => $multiple_foto,
            ]);
        }


        $ukuran = $request->luas . " X " . $request->lebar . ' ' . "meter";

        $cover = $request->cover;
        $new_cover = 'No' . " " . $pintu . "." . Auth::user()->name . "." . $cover->getClientOriginalExtension();
        $destination = 'images/kamar/';
        $cover->move($destination, $new_cover);

        Kamar::create([
            'pintu_id'          => $pintu,
            'ukuran'            => $ukuran,
            'cover'              => $new_cover,
            'deskripsi'         => $request->deskripsi,
            'tampil'            => $request->tampil,
            'harga'             => $request->harga,
            'status'            => $request->status
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar Berhasil ditambah!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(kamar $kamar)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kamar = Kamar::whereId($id)->first();
        $no = Kamar::where('id', '!=', $id)->pluck('pintu_id');
        $pintu = Pintu::whereNotIn('id', $no)->get();
        return view('backend.kamar.edit', compact('kamar', 'pintu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pintu_id'          => 'required',
            'ukuran'            => 'required',
            'deskripsi'         => 'required',
            'tampil'            => 'required',
            'harga'             => 'required',
            'status'            => 'required',
        ]);

        $pintu = $request->pintu_id;
        if ($request->multiple) {
            foreach ($request->multiple as $key => $value) {
                $multiple_foto = $key . '_No' . " " . $pintu . "." . Auth::user()->name . "." . $value->getClientOriginalExtension();
                $destination = 'images/kamar/multiple';
                $value->move($destination, $multiple_foto);
                Foto::create([
                    'kamar_id'  => $id,
                    'nama'      => $multiple_foto,
                ]);
            }
        }


        if ($request->cover) {
            $kamar = Kamar::whereId($id)->first();
            if ($request->status == 1) {
                if (file_exists(public_path() . '/images/kamar' . $kamar->cover)) {
                    unlink(public_path() . '/images/kamar' . $kamar->cover);
                }
            }
            $cover = $request->cover;
            $new_cover = 'No' . " " . $pintu . "." . Auth::user()->name . "." . $cover->getClientOriginalExtension();
            $destination = 'images/kamar/';
            $cover->move($destination, $new_cover);
            Kamar::whereId($id)->update([
                'pintu_id'          => $pintu,
                'ukuran'            => $request->ukuran,
                'cover'             => $new_cover,
                'deskripsi'         => $request->deskripsi,
                'tampil'            => $request->tampil,
                'harga'             => $request->harga,
                'status'            => $request->status
            ]);
        } else {
            Kamar::whereId($id)->update([
                'pintu_id'          => $pintu,
                'ukuran'            => $request->ukuran,
                'deskripsi'         => $request->deskripsi,
                'tampil'            => $request->tampil,
                'harga'             => $request->harga,
                'status'            => $request->status
            ]);
        }


        return redirect()->route('kamar.index')->with('success', 'Data Kamar Berhasil dibaharui!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $Kamar = Transaksi::where('kamar_id', $request->delete_id)->where('status', '!=', 0)->get();
        if ($Kamar->isNotEmpty()) {
            return redirect()->back()->with('error', 'Kamar Sedang digunakan!.');
        } else {
            Pintu::whereId($request->delete_id)->delete();
            return redirect()->back()->with('success', 'Kamar Pintu Berhasil dihapus!.');
        }
    }
}
