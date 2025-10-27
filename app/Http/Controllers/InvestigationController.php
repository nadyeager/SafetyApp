<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;
use App\Models\Accident_Investigations;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Accident $accident)
    {
        $investigation = Accident_Investigations::with(['accident_id']);

        return view('admin.investigation.index', compact('investigation', 'accident'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Accident_Investigations $investigation, Accident $accident)
    {
        if($investigation->isEmpty())  {
            return view('admin.investigation.create', compact('accident', 'investigation'));
        } else {
        return view('admin.investigation.index', compact('investigation', 'accident'));
    }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'investigator' => 'required|string',
            'root_cause' => 'required|string',
            'corrective_action' => 'required|string',
        ]);

        Accident_Investigations::create([
            'accident_id' => $request->accident_id,
            'investigator' => $request->investigator,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action,
        ]);

        return redirect()->route('investigation.index')->with('success', 'Investigation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
