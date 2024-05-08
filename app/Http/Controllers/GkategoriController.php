<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gkategori;
use Illuminate\Http\Request;

class GkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gkategori = Gkategori::paginate(10); // get data from model and paginate
        // return view('gkategori.gkategori', compact('gkategori'));
        return response()->view('gkategori.gkategori', compact('gkategori')); //test this
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
            'desc_kategori' => 'required'
        ], [], [
            'nama_kategori' => 'nama katagori',
            'desc_katagori' => 'deskripsi kategori'
        ]);

        $gkategori = Gkategori::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($gkategori); // return data in json format
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gkategori = Gkategori::find($request->id);

        return response()->json($gkategori);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gkategori::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gkategori = Gkategori::find($request->id);
        return response()->json($gkategori);
    }
}
