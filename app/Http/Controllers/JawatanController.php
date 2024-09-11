<?php

namespace App\Http\Controllers;

use App\Models\Jawatan;
use App\Http\Requests\JawatanRequest;
use Illuminate\Http\Request;

class JawatanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $jawatan = Jawatan::latest()->paginate(10);
        return view('jawatan.jawatan', compact('jawatan'));
    }

    public function store(JawatanRequest $request)
    {
        $jawatan = Jawatan::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($jawatan);
    }

    public function edit(Request $request)
    {
        $jawatan = Jawatan::findOrFail($request->id);
        return response()->json($jawatan);
    }

    public function destroy(Request $request)
    {
        Jawatan::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $jawatan = Jawatan::findOrFail($request->id);
        return response()->json($jawatan);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $jawatan = Jawatan::where(function ($query) use ($search) {
            $query->where('kod_jawatan', 'like', "%$search%")
                ->orWhere('desc_jawatan', 'like', "%$search%");
        })->get();

        return response()->json(['data' => $jawatan]);
    }
}
