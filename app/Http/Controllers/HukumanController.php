<?php

namespace App\Http\Controllers;

use App\Models\Hukuman;
use App\Http\Requests\HukumanRequest;
use Illuminate\Http\Request;

class HukumanController extends Controller
{
    public function index()
    {
        $hukuman = Hukuman::latest()->paginate(10);
        return view('hukuman.hukuman', compact('hukuman'));
    }

    public function store(HukumanRequest $request)
    {
        $hukuman = Hukuman::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($hukuman);
    }

    public function edit(Request $request)
    {
        $hukuman = Hukuman::findOrFail($request->id);
        return response()->json($hukuman);
    }

    public function destroy(Request $request)
    {
        Hukuman::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $hukuman = Hukuman::findOrFail($request->id);
        return response()->json($hukuman);
    }
}
