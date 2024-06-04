<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Gkcuti;
use Illuminate\Http\Request;

class GkcutiController extends Controller
{
    public function index()
    {
        $gkcuti = Gkcuti::paginate(10);
        return view('gkcuti.gkcuti', compact('gkcuti'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_cuti' => 'required|max:50',
        ]);

        Gkcuti::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data gkcuti berjaya disimpan.'
        ]);
    }

    public function edit($id)
    {
        $gkcuti = Gkcuti::find($id);
        return response()->json($gkcuti);
    }

    public function destroy($id)
    {
        Gkcuti::destroy($id);
        return response()->json(['success' => true]);
    }

    public function view($id)
    {
        $gkcuti = Gkcuti::find($id);
        return response()->json($gkcuti);
    }
}
