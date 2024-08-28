<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::paginate(10);
        return view('status.status', compact('status'));
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
            'kod_status' => 'required',
            'desc_status' => 'required'
        ], [], [
            'kod_status' => 'Status',
            'desc_status' => 'Deskripsi Status'
        ]);

        $status = Status::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $status = Status::find($request->id);
        return response()->json($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Status::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $status = Status::find($request->id);
        return response()->json($status);
    }
}
