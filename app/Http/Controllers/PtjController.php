<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Ptj;
use Illuminate\Http\Request;

class PtjController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $ptj = Ptj::paginate(10);
        return view('ptj.ptj', compact('ptj'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kod_ptj' => 'required',
            'desc_ptj' => 'required',
            'ketua_ptj' => 'required',
            'alamat_ptj' => 'required'
        ], [], [
            'kod_ptj' => 'Kod Ptj',
            'desc_ptj' => 'Nama Ptj',
            'ketua_ptj' => 'Nama Ketua Ptj',
            'alamat_ptj' => 'Alamat Ptj'
        ]);

        $ptj = Ptj::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($ptj);
    }

    public function edit(Request $request)
    {
        $ptj = Ptj::find($request->id);

        return response()->json($ptj);
    }

    public function destroy(Request $request)
    {
        Ptj::destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function view(Request $request)
    {
        $ptj = Ptj::find($request->id);
        return response()->json($ptj);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $ptj = Ptj::where(function ($query) use ($search) {
            $query->where('kod_gred', 'like', "%$search%")
                ->orWhere('desc_gred', 'like', "%$search%");
        })->get();

        return response()->json(['data' => $ptj]);
    }
}
