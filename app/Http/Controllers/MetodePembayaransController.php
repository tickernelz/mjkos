<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetodePembayaransController extends Controller
{
    public function index()
    {
        $metode = MetodePembayaran::all();
        return view('backend.metodePembayaran.index', compact('metode'));
    }

    public function create()
    {
        return view('backend.metodePembayaran.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time() . '_' . Auth::user()->name . "_" . $gambar->getClientOriginalName();
        $destination = 'images/metode_pembayaran/';
        $gambar->move($destination, $new_gambar);
        $roles = Auth::user()->getRoleNames();

        if ($roles->contains('admin')) {
            MetodePembayaran::create([
                'nama' => $request->nama,
                'gambar' => $new_gambar,
                'status' => $request->status,
            ]);
        } else {
            MetodePembayaran::create([
                'user_id' => auth()->user()->id,
                'nama' => $request->nama,
                'gambar' => $new_gambar,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('metode_pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    public function show(MetodePembayaran $metodePembayaran)
    {

    }

    public function edit(MetodePembayaran $metodePembayaran)
    {
        $metode = MetodePembayaran::whereId($metodePembayaran->id)->first();
        return view('backend.metodePembayaran.edit', compact('metode'));
    }

    public function update(Request $request, MetodePembayaran $metodePembayaran)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
        ]);

        $metode = MetodePembayaran::whereId($metodePembayaran->id)->first();

        if ($request->hasFile('gambar')) {
            $gambar = $request->gambar;
            $new_gambar = time() . '_' . Auth::user()->name . "_" . $gambar->getClientOriginalName();
            $destination = 'images/metode_pembayaran/';
            $gambar->move($destination, $new_gambar);

            $metode->update([
                'nama' => $request->nama,
                'gambar' => $new_gambar,
                'status' => $request->status,
            ]);
        } else {
            $metode->update([
                'nama' => $request->nama,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('metode_pembayaran.index')->with('success', 'Metode Pembayaran berhasil diubah');
    }

    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $metode = MetodePembayaran::whereId($metodePembayaran->id)->first();
        $metode->delete();
        return redirect()->route('metode_pembayaran.index')->with('success', 'Metode Pembayaran berhasil dihapus');
    }
}
