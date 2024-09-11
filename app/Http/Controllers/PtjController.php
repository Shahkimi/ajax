<?php

namespace App\Http\Controllers;

use App\Models\Ptj;
use App\Http\Requests\PtjRequest;
use Illuminate\Http\Request;

class PtjController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $ptj = Ptj::latest()->paginate(10);
        return view('ptj.ptj', compact('ptj'));
    }

    public function store(PtjRequest $request)
    {
        $ptj = Ptj::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($ptj);
    }

    public function edit(Request $request)
    {
        $ptj = Ptj::findOrFail($request->id);
        return response()->json($ptj);
    }

    public function destroy(Request $request)
    {
        Ptj::destroy($request->id);
        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $ptj = Ptj::findOrFail($request->id);
        return response()->json($ptj);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $ptj = Ptj::where(function ($query) use ($search) {
            $query->where('kod_ptj', 'like', "%$search%")
                ->orWhere('desc_ptj', 'like', "%$search%")
                ->orWhere('ketua_ptj', 'like', "%$search%")
                ->orWhere('alamat_ptj', 'like', "%$search%");
        })->get();

        return response()->json(['data' => $ptj]);
    }
}
