<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Akta;
use Illuminate\Http\Request;

class AktaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akta = Akta::paginate(10);
        return view('akta.akta', compact('akta'));
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
            'kod_akta' => 'required',
            'desc_akta' => 'required'
        ], [], [
            'kod_akta' => 'Kod Akta',
            'desc_akta' => 'Deskripsi Akta'
        ]);

        $akta = Akta::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($akta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $akta = Akta::find($request->id);

        return response()->json($akta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Akta::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $akta = Akta::find($request->id);
        return response()->json($akta);
    }
}
