<?php

namespace App\Http\Controllers;

use App\Models\Gred;
use App\Http\Requests\GredRequest;
use Illuminate\Http\Request;

class GredController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $gred = Gred::latest()->paginate(10);
        return view('gred.gred', compact('gred'));
    }

    public function store(GredRequest $request)
    {
        $gred = Gred::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($gred);
    }

    public function edit(Request $request)
    {
        $gred = Gred::findOrFail($request->id);
        return response()->json($gred);
    }

    public function destroy(Request $request)
    {
        Gred::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $gred = Gred::findOrFail($request->id);
        return response()->json($gred);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $gred = Gred::where(function ($query) use ($search) {
            $query->where('kod_gred', 'like', "%$search%")
                ->orWhere('desc_gred', 'like', "%$search%");
        })->get();

        return response()->json(['data' => $gred]);
    }
}
