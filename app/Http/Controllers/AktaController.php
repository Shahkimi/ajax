<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Akta;
use Illuminate\Http\Request;

class AktaController extends Controller
{
    public function index()
    {
        $akta = Akta::paginate(10);
        return view('akta.akta', compact('akta'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kod_akta' => 'required',
            'desc_akta' => 'required'
        ], [], [
            'kod_akta' => 'Kod Akta',
            'desc_akta' => 'Deskripsi Akta'
        ]);

        $akta = Akta::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($akta);
    }

    public function edit(Request $request)
    {
        $akta = Akta::find($request->id);

        return response()->json($akta);
    }

    public function destroy(Request $request)
    {
        Akta::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $akta = Akta::find($request->id);
        return response()->json($akta);
    }
}
