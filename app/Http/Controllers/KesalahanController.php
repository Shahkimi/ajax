<?php

namespace App\Http\Controllers;

use App\Models\Kesalahan;
use App\Http\Requests\KesalahanRequest;
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
        $kesalahan = Kesalahan::latest()->paginate(10);
        return view('kesalahan.kesalahan', compact('kesalahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\KesalahanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KesalahanRequest $request)
    {
        $kesalahan = Kesalahan::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($kesalahan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $kesalahan = Kesalahan::findOrFail($request->id);
        return response()->json($kesalahan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Kesalahan::destroy($request->id);
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
        $kesalahan = Kesalahan::findOrFail($request->id);
        return response()->json($kesalahan);
    }
}
