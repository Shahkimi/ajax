<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Http\Requests\PanelRequest;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $panel = Panel::latest()->get();
        return view('panel.panel', compact('panel'));
    }

    public function store(PanelRequest $request)
    {
        $panel = Panel::updateOrCreate(
            ['id' => $request->id],
            $request->validated()
        );

        return response()->json($panel);
    }

    public function edit(Request $request)
    {
        $panel = Panel::findOrFail($request->id);
        return response()->json($panel);
    }

    public function view(Request $request)
    {
        $panel = Panel::findOrFail($request->id);
        return response()->json($panel);
    }
}
