<?php

namespace App\Http\Controllers;

use App\Models\Bangsa;
use App\Http\Requests\BangsaRequest;
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
        $bangsa = Bangsa::latest()->paginate(10);
        return view('bangsa.bangsa', compact('bangsa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BangsaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BangsaRequest $request)
    {
        $bangsa = Bangsa::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($bangsa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $bangsa = Bangsa::findOrFail($request->id);
        return response()->json($bangsa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Bangsa::destroy($request->id);
        return response()->json(['success' => true]);
    }

    /**
     * View the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $bangsa = Bangsa::findOrFail($request->id);
        return response()->json($bangsa);
    }
}
