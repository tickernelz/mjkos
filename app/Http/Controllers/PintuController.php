<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pintu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PintuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pintu = Pintu::orderby('nama')->get();
        return view('backend.pintu.index', compact('pintu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pintu.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Pintu::max('nama') + 1;
        Pintu::create([
            'nama'          => $cek,
        ]);

        return redirect()->back()->with('success', 'Nomer Pintu Berhasil ditambah!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pintu  $pintu
     * @return \Illuminate\Http\Response
     */
    public function show(Pintu $pintu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pintu  $pintu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pintu = Pintu::whereId($id)->first();
        return view('backend.pintu.edit', compact('pintu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pintu  $pintu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required',
        ]);

        $Kamar = Pintu::where('nama', $request->nama)->get();
        if ($Kamar->isNotEmpty()) {
            return redirect()->route('pintu.index')->with('error', 'Nomer Pintu Sudah Ada!.');
        } else {
            Pintu::whereId($id)->update([
                'nama'          => $request->nama,
            ]);

            return redirect()->route('pintu.index')->with('success', 'Nomer Pintu Berhasil diubah!.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pintu  $pintu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $Kamar = Kamar::where('pintu_id', $request->delete_id)->get();
        if ($Kamar->isNotEmpty()) {
            return redirect()->back()->with('error', 'Nomer Pintu Sedang digunakan!.');
        } else {
            $delete = Pintu::whereId($request->delete_id)->delete();
            return redirect()->route('pintu.index')->with('success', 'Nomer Pintu Berhasil dihapus!.');
        }
    }
}
