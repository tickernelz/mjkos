<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kos;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{

    public function index($id)
    {
        $kos = Kos::whereId($id)->first();
        $fasilitas = Fasilitas::where('kos_id', $kos->id)->get();
        return view('backend.fasilitas.index', compact('kos', 'fasilitas'));
    }

    public function create($kos_id)
    {
        $kos = Kos::whereId($kos_id)->first();
        return view('backend.fasilitas.add', compact('kos'));
    }

    public function store(Request $request, $kos_id)
    {
        // Validations
        $request->validate([
            'nama' => 'required',
        ]);

        Fasilitas::create([
            'kos_id' => $kos_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('fasilitas.index', $kos_id)->with('success', 'Fasilitas Berhasil ditambah!.');
    }

    public function show(fasilitas $fasilitas)
    {
        //
    }

    public function edit($kos_id, $fas_id)
    {
        $kos = Kos::whereId($kos_id)->first();
        $fasilitas = Fasilitas::whereId($fas_id)->first();
        return view('backend.fasilitas.edit', compact('kos', 'fasilitas'));
    }

    public function update(Request $request, $kos_id, $id)
    {
        // Validations
        $request->validate([
            'nama' => 'required',
        ]);

        Fasilitas::whereId($id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('fasilitas.index', $kos_id)->with('success', 'Fasilitas Berhasil diubah!.');
    }

    public function destroy($kos_id, $id)
    {
        $delete = Fasilitas::whereId($id)->delete();
        if ($delete) {
            return redirect()->route('fasilitas.index', $kos_id)->with('success', 'Fasilitas Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Fasilitas Gagal dihapus!.');
        }
    }
}
