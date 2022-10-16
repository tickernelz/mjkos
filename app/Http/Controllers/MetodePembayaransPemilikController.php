<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\MetodePembayaranPemilik;
use Illuminate\Http\Request;

class MetodePembayaransPemilikController extends Controller
{
    public function index()
    {
        $metode = MetodePembayaranPemilik::all();
        return view('backend.metodePembayaranPemilik.index', compact('metode'));
    }

    public function create()
    {
        $metode = MetodePembayaran::whereDoesntHave('MetodePembayaranPemilik', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('backend.metodePembayaranPemilik.add', compact('metode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required',
            'status' => 'required',
        ]);

        $metode = MetodePembayaranPemilik::create([
            'user_id' => auth()->user()->id,
            'metode_pembayaran_id' => $request->nama,
            'nomor' => $request->nomor,
            'status' => $request->status,
        ]);
        $metode->save();

        return redirect()->route('metode_pembayaran_pemilik.index')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    public function show(MetodePembayaranPemilik $metodePembayaranPemilik)
    {

    }

    public function edit(MetodePembayaranPemilik $metodePembayaranPemilik)
    {
        $metode = MetodePembayaranPemilik::whereId($metodePembayaranPemilik->id)->first();
        return view('backend.metodePembayaranPemilik.edit', compact('metode'));
    }

    public function update(Request $request, MetodePembayaranPemilik $metodePembayaranPemilik)
    {
        $request->validate([
            'nomor' => 'required',
            'status' => 'required',
        ]);

        $metode = MetodePembayaranPemilik::whereId($metodePembayaranPemilik->id)->first();

        $metode->update([
            'nomor' => $request->nomor,
            'status' => $request->status,
        ]);

        return redirect()->route('metode_pembayaran_pemilik.index')->with('success', 'Metode Pembayaran berhasil diubah');
    }

    public function destroy(MetodePembayaranPemilik $metodePembayaranPemilik)
    {
        $metode = MetodePembayaranPemilik::whereId($metodePembayaranPemilik->id)->first();
        $metode->delete();

        return redirect()->route('metode_pembayaran_pemilik.index')->with('success', 'Metode Pembayaran berhasil dihapus');
    }
}
