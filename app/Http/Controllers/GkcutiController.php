<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gkcuti;
use Illuminate\Http\Request;

class GkcutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gkcuti = Gkcuti::paginate(10); // get data from model and paginate
        return view('gkcuti.gkcuti', compact('gkcuti'));
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
        ], [], [
            'kategori_cuti' => 'Kategori Cuti',
        ]); // data validation

        $gkcuti = Gkcuti::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($gkcuti); // return data in json format
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gkcuti = Gkcuti::find($request->id); // get data from model

        return response()->json($gkcuti);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gkcuti::destroy($request->id); // delete data from model

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gkcuti = Gkcuti::find($request->id);

        return response()->json($gkcuti);
    }
}
