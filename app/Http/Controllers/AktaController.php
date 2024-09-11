<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Http\Requests\AktaRequest;
use Illuminate\Http\Request;

class AktaController extends Controller
{
    public function index()
    {
        $akta = Akta::latest()->paginate(10);
        return view('akta.akta', compact('akta'));
    }

    public function store(AktaRequest $request)
    {
        $akta = Akta::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($akta);
    }

    public function edit(Request $request)
    {
        $akta = Akta::findOrFail($request->id);
        return response()->json($akta);
    }

    public function destroy(Request $request)
    {
        Akta::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $akta = Akta::findOrFail($request->id);
        return response()->json($akta);
    }
}
