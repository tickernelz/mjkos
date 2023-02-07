<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\RekeningPembayaran;
use Illuminate\Http\Request;

class RekeningPembayaranController extends Controller
{
    public function index()
    {
        $metode = RekeningPembayaran::all();
        return view('backend.rekeningPembayaran.index', compact('metode'));
    }

    public function create()
    {
        $metode_all = MetodePembayaran::whereNull('user_id')->whereDoesntHave('RekeningPembayaran', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $metode_user = MetodePembayaran::where('user_id', auth()->user()->id)->whereDoesntHave('RekeningPembayaran', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $metode = $metode_all->merge($metode_user);
        return view('backend.rekeningPembayaran.add', compact('metode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required',
            'status' => 'required',
        ]);

        $metode = RekeningPembayaran::create([
            'user_id' => auth()->user()->id,
            'metode_pembayaran_id' => $request->nama,
            'nomor' => $request->nomor,
            'status' => $request->status,
        ]);
        $metode->save();

        return redirect()->route('rekening_pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    public function show(RekeningPembayaran $rekeningPembayaran)
    {

    }

    public function edit(RekeningPembayaran $rekeningPembayaran)
    {
        $metode = RekeningPembayaran::whereId($rekeningPembayaran->id)->first();
        return view('backend.rekeningPembayaran.edit', compact('metode'));
    }

    public function update(Request $request, RekeningPembayaran $rekeningPembayaran)
    {
        $request->validate([
            'nomor' => 'required',
            'status' => 'required',
        ]);

        $metode = RekeningPembayaran::whereId($rekeningPembayaran->id)->first();

        $metode->update([
            'nomor' => $request->nomor,
            'status' => $request->status,
        ]);

        return redirect()->route('rekening_pembayaran.index')->with('success', 'Metode Pembayaran berhasil diubah');
    }

    public function destroy(RekeningPembayaran $rekeningPembayaran)
    {
        $metode = RekeningPembayaran::whereId($rekeningPembayaran->id)->first();
        $metode->delete();

        return redirect()->route('rekening_pembayaran.index')->with('success', 'Metode Pembayaran berhasil dihapus');
    }
}
