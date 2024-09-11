<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StatusRequest;
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
        $status = Status::latest()->paginate(10);
        return view('status.status', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        $status = Status::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $status = Status::findOrFail($request->id);
        return response()->json($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Status::destroy($request->id);
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
        $status = Status::findOrFail($request->id);
        return response()->json($status);
    }
}
