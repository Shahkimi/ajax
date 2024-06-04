<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gcuti;
use App\Models\Gkcuti;
use Illuminate\Http\Request;

class GcutiController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gkcutiOptions = Gkcuti::pluck('kategori_cuti', 'id'); // Fetch kategori_cuti as options
        $gcuti = Gcuti::with('gkcuti')->paginate(10); // get data from model and paginate
        return view('gcuti.gcuti', compact('gcuti', 'gkcutiOptions'));
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
            'gkcuti_id' => 'required|exists:gkcutis,id',
            'jenis_cuti' => 'required|string|max:255',
        ], [], [
            'gkcuti_id' => 'Kategori Cuti',
            'jenis_cuti' => 'Jenis Cuti',
        ]);

        $gcuti = Gcuti::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($gcuti); // return data in json format
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gcuti = Gcuti::with('gkcuti')->find($request->id);

        return response()->json($gcuti);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gcuti::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gcuti = Gcuti::with('gkcuti')->find($request->id);
        return response()->json($gcuti);
    }
}
