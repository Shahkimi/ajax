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

        if ($request->ajax()) {
            $gred = Gred::where('kod_gred', 'like', '%' . $query . '%')
                ->orWhere('desc_gred', 'like', '%' . $query . '%')
                ->paginate(25);

            return view('gred.Partials.gred_data', compact('gred'))->render();
        }

        $gred = Gred::paginate(25);
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
}
