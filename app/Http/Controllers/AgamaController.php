<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use Datatables;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return datatables(Agama::select('id', 'nama_Agama', 'desc_Agama', 'created_at'))
            ->editColumn('created_at', fn($request) => $request->created_at->format('d-m-Y H:i')) // format date time
            ->addColumn('action', 'agama.agama-action')
            ->rawColumns(['action'])
            ->toJson(); // Use this method instead of make(true) for faster and more efficient
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_Agama' => 'required',
            'desc_Agama' => 'required'
        ], [], [
            'nama_Agama' => 'nama agama',
            'desc_Agama' => 'deskripsi agama'
        ]);

        $agama = Agama::updateOrCreate(['id' => $request->id], $request->only('nama_Agama', 'desc_Agama'));

        return response()->json($agama, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $agama  = Agama::where($where)->first();

        return Response()->json($agama);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $agama = Agama::where('id', $request->id)->delete();

        return Response()->json($agama);
    }
}
