<?php

namespace App\Http\Controllers;

use App\Models\Jawatan;
use Illuminate\Http\Request;

class JawatanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $jawatan = Jawatan::paginate(10);
        return view('jawatan.jawatan', compact('jawatan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kod_jawatan' => 'required',
            'desc_jawatan' => 'required'
        ], [], [
            'kod_jawatan' => 'Kod Jawatan',
            'desc_jawatan' => 'Deskripsi Jawatan'
        ]);

        $jawatan = Jawatan::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($jawatan);
    }

    public function edit(Request $request)
    {
        $jawatan = Jawatan::find($request->id);

        return response()->json($jawatan);
    }

    public function destroy(Request $request)
    {
        Jawatan::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $jawatan = Jawatan::find($request->id);
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
