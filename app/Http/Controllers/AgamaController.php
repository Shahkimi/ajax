<?php

namespace App\Http\Controllers;


use App\Models\Agama;
use Datatables;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agama = Agama::paginate(10);
        return view('agama.agama', compact('agama'));
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
            'nama_agama' => 'required',
            'desc_agama' => 'required'
        ], [], [
            'nama_agama' => 'nama agama',
            'desc_agama' => 'deskripsi agama'
        ]);

        $agama = Agama::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($agama);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $agama = Agama::find($request->id);

        return response()->json($agama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Agama::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $agama = Agama::find($request->id);
        return response()->json($agama);
    }

}
