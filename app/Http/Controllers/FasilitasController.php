<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{

    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('backend.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('backend.fasilitas.add');
    }

    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'nama'          => 'required',
        ]);

        Fasilitas::create([
            'nama'          => $request->nama,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas Berhasil ditambah!.');
    }

    public function show(fasilitas $fasilitas)
    {
        //
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::whereId($id)->first();
        return view('backend.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        // Validations
        $request->validate([
            'nama'          => 'required',
        ]);

        Fasilitas::whereId($id)->update([
            'nama'          => $request->nama,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas Berhasil diubah!.');
    }

    public function destroy($id, Request $request)
    {
        $delete = Fasilitas::whereId($request->delete_id)->delete();
        if ($delete) {
            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Fasilitas Gagal dihapus!.');
        }
    }
}
