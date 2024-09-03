<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $panel = Panel::paginate(10);
        return view('panel.panel', compact('panel'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengurusi' => 'required',
            'mpm_pengurusi' => 'required',
            'nama_panel' => 'required',
            'nama_panel2' => 'required',
            'mpm_panel2' => 'required',
            'jawatan_panel2' => 'required',
            'tajuk_panel2' => 'required',
            'penyemak' => 'required',
            'jawatan_penyemak' => 'required'
        ], [], [
            'nama_pengurusi' => 'Nama Pengurusi',
            'mpm_pengurusi' => 'No MPM Pengurusi',
            'nama_panel' => 'Nama Panel 1',
            'nama_panel2' => 'Nama Panel 2',
            'mpm_panel2' => 'No MPM Panel 2',
            'jawatan_panel2' => 'Jawatan Panel 2',
            'tajuk_panel2' => 'Tajuk Panel 2',
            'penyemak' => 'Nama Penyemak',
            'jawatan_penyemak' => 'Jawatan Penyemak'
        ]);

        $panel = Panel::updateOrCreate(['id' => $request->id], $validatedData);

        return response()->json($panel);
    }

    public function edit(Request $request)
    {
        $panel = Panel::find($request->id);

        return response()->json($panel);
    }

    public function view(Request $request)
    {
        $panel = Panel::find($request->id);
        return response()->json($panel);
    }
}
