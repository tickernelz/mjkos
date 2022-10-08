<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peraturan = Peraturan::all();
        return view('backend.peraturan.index', compact('peraturan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.peraturan.add');
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

        Peraturan::create([
            'nama'          => $request->nama,
        ]);

        return redirect()->route('peraturan.index')->with('success', 'Peraturan Berhasil ditambah!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peraturan  $peraturan
     * @return \Illuminate\Http\Response
     */
    public function show(peraturan $peraturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peraturan  $peraturan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peraturan = Peraturan::whereId($id)->first();
        return view('backend.peraturan.edit', compact('peraturan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peraturan  $peraturan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validations
        $request->validate([
            'nama'          => 'required',
        ]);

        Peraturan::whereId($id)->update([
            'nama'          => $request->nama,
        ]);

        return redirect()->route('peraturan.index')->with('success', 'Peraturan Berhasil diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peraturan  $peraturan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = Peraturan::whereId($request->delete_id)->delete();
        if ($delete) {
            return redirect()->route('peraturan.index')->with('success', 'Peraturan Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Peraturan Gagal dihapus!.');
        }
    }
}
