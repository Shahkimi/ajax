<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gred;
use Illuminate\Http\Request;

class GredController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $gred = Gred::paginate(10);
        return view('gred.gred', compact('gred'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kod_gred' => 'required',
            'desc_gred' => 'required'
        ], [], [
            'kod_gred' => 'Kod Gred',
            'desc_gred' => 'Deskripsi Gred'
        ]);

        $gred = Gred::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($gred);
    }

    public function edit(Request $request)
    {
        $gred = Gred::find($request->id);

        return response()->json($gred);
    }

    public function destroy(Request $request)
    {
        Gred::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gred = Gred::find($request->id);
        return response()->json($gred);
    }

     public function search(Request $request)
    {

        $search = $request->search;

        $gred = Gred::where(function ($query) use ($search) {

            $query->where('kod_gred', 'like', "%$search%")
            ->orWhere('desc_gred', 'like', "%$search%");
        })->get();

        return view('gred.gred', compact('gred', 'search'));
    }
}
