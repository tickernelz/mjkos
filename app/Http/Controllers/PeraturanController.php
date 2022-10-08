<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index($id)
    {
        $kos = Kos::whereId($id)->first();
        $peraturan = Peraturan::where('kos_id', $kos->id)->get();
        return view('backend.peraturan.index', compact('peraturan', 'kos'));
    }

    public function create($kos_id)
    {
        $kos = Kos::whereId($kos_id)->first();
        return view('backend.peraturan.add', compact('kos'));
    }

    public function store(Request $request, $kos_id)
    {
        // Validations
        $request->validate([
            'nama' => 'required',
        ]);

        Peraturan::create([
            'kos_id' => $kos_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('peraturan.index', $kos_id)->with('success', 'Peraturan Berhasil ditambah!.');
    }

    public function show(peraturan $peraturan)
    {
        //
    }

    public function edit($kos_id, $id)
    {
        $kos = Kos::whereId($kos_id)->first();
        $peraturan = Peraturan::whereId($id)->first();
        return view('backend.peraturan.edit', compact('peraturan', 'kos'));
    }

    public function update(Request $request, $kos_id, $id)
    {
        // Validations
        $request->validate([
            'nama' => 'required',
        ]);

        Peraturan::whereId($id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('peraturan.index', $kos_id)->with('success', 'Peraturan Berhasil diubah!.');
    }

    public function destroy($kos_id, $id)
    {
        $delete = Peraturan::whereId($id)->delete();
        if ($delete) {
            return redirect()->route('peraturan.index', $kos_id)->with('success', 'Peraturan Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Peraturan Gagal dihapus!.');
        }
    }
}
