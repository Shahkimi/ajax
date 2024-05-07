<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gelaran;
use Illuminate\Http\Request;

class GelaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gelaran = Gelaran::paginate(10);
        return view('gelaran.gelaran', compact('gelaran'));
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
            'nama_gelaran' => 'required',
            'desc_gelaran' => 'required'
        ], [], [
            'nama_gelaran' => 'nama gelaran',
            'desc_gelaran' => 'deskripsi gelaran'
        ]);

        $gelaran = Gelaran::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($gelaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gelaran = Gelaran::find($request->id);

        return response()->json($gelaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gelaran::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gelaran = Gelaran::find($request->id);
        return response()->json($gelaran);
    }
}
