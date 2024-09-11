<?php

namespace App\Http\Controllers;

use App\Models\Gelaran;
use App\Http\Requests\GelaranRequest;
use Illuminate\Http\Request;

class GelaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gelaran = Gelaran::latest()->paginate(10);
        return view('gelaran.gelaran', compact('gelaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\GelaranRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GelaranRequest $request)
    {
        $gelaran = Gelaran::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($gelaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $gelaran = Gelaran::findOrFail($request->id);
        return response()->json($gelaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gelaran::destroy($request->id);
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
        $gelaran = Gelaran::findOrFail($request->id);
        return response()->json($gelaran);
    }
}
