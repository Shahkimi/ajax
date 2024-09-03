<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Hukuman;
use Illuminate\Http\Request;

class hukumanController extends Controller
{
    public function index()
    {
        $hukuman = Hukuman::paginate(10);
        return view('hukuman.hukuman', compact('hukuman'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kod_hukuman' => 'required',
            'desc_hukuman' => 'required'
        ], [], [
            'kod_hukuman' => 'Kod Hukuman',
            'desc_hukuman' => 'Deskripsi Hukuman'
        ]);

        $hukuman = Hukuman::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($hukuman);
    }

    public function edit(Request $request)
    {
        $hukuman = Hukuman::find($request->id);

        return response()->json($hukuman);
    }

    public function destroy(Request $request)
    {
        Hukuman::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $hukuman = Hukuman::find($request->id);
        return response()->json($hukuman);
    }
}
