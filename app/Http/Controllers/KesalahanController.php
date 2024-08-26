<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Kesalahan;
use Illuminate\Http\Request;

class KesalahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesalahan = Kesalahan::paginate(10);
        return view('kesalahan.kesalahan', compact('kesalahan'));
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
            'kod_kesalahan' => 'required',
            'desc_kesalahan' => 'required'
        ], [], [
            'kod_kesalahan' => 'nama kesalahan',
            'desc_kesalahan' => 'deskripsi kesalahan'
        ]);

        $kesalahan = Kesalahan::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($kesalahan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $kesalahan = Kesalahan::find($request->id);

        return response()->json($kesalahan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Kesalahan::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $kesalahan = Kesalahan::find($request->id);
        return response()->json($kesalahan);
    }
}
