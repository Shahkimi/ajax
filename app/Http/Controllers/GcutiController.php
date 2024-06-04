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
        $gcuti = Gcuti::paginate(10); // get data from model and paginate
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
            'kategori_cuti' => 'required',
            'jenis_cuti' => 'required',
            'gkcuti_id' => 'required|exists:gkcutis,id'
        ], [], [
            'kategori_cuti' => 'Kategori Cuti',
            'jenis_cuti' => 'Jenis Cuti',
            'gkcuti_id' => 'Kategori Cuti Option'
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
        $gcuti = Gcuti::find($request->id);

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
        $gcuti = Gcuti::find($request->id);
        return response()->json($gcuti);
    }
}
