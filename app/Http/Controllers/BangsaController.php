<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Bangsa;
use Illuminate\Http\Request;

class BangsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bangsa = Bangsa::paginate(10);
        return view('bangsa.bangsa', compact('bangsa'));
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
            'nama_bangsa' => 'required',
            'desc_bangsa' => 'required'
        ], [], [
            'nama_bangsa' => 'nama bangsa',
            'desc_bangsa' => 'deskripsi bangsa'
        ]);

        $bangsa = Bangsa::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($bangsa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $bangsa = Bangsa::find($request->id);

        return response()->json($bangsa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Bangsa::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $bangsa = Bangsa::find($request->id);
        return response()->json($bangsa);
    }

}
