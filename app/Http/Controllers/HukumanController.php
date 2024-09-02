<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Hukuman;
use Illuminate\Http\Request;

class hukumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hukuman = Hukuman::paginate(10);
        return view('hukuman.hukuman', compact('hukuman'));
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
            'kod_hukuman' => 'required',
            'desc_hukuman' => 'required'
        ], [], [
            'kod_hukuman' => 'Kod Hukuman',
            'desc_hukuman' => 'Deskripsi Hukuman'
        ]);

        $hukuman = Hukuman::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($hukuman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $hukuman = Hukuman::find($request->id);

        return response()->json($hukuman);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Hukuman::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $hukuman = Hukuman::find($request->id);
        return response()->json($hukuman);
    }
}
