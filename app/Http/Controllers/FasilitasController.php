<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('backend.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.fasilitas.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function show(fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::whereId($id)->first();
        return view('backend.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
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
