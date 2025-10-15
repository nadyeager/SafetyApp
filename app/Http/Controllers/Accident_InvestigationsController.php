<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accident;
use App\Models\accident_investigations;

class Accident_InvestigationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investigation = accident_investigations::all();
        return view('admin.investigation', compact('investigation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Accident $accident)
    {
        return view('admin.investigation_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Accident $accidents)
    {
        $request->validate([
            'accident_id' => 'required|exists:accidents,id',
            'investigator' => 'required|string',
            'root_cause' => 'required|string',
            'corrective_action' => 'required|string',
        ]);

        accident_investigations::create([
            'accident_id' => $request->accident_id,
            'investigator' => $request->investigator,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action
        ]);

        return redirect()->route('admin.investigation')->with('success', 'Accident Investigation created successfully.');   
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
