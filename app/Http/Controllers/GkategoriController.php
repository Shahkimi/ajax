<?php

namespace App\Http\Controllers;

use App\Models\Gkategori;
use App\Http\Requests\GkategoriRequest;
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
        $gkategori = Gkategori::latest()->paginate(10);
        return view('gkategori.gkategori', compact('gkategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\GkategoriRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GkategoriRequest $request)
    {
        $gkategori = Gkategori::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($gkategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gkategori = Gkategori::findOrFail($request->id);
        return response()->json($gkategori);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gkategori::destroy($request->id);
        return response()->json(['success' => true]);
    }

    /**
     * View the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $gkategori = Gkategori::findOrFail($request->id);
        return response()->json($gkategori);
    }
}
