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
      $investigation = Accident_Investigations::where('accident_id', $accident->id)->first();

      if(!$investigation) {
        return redirect()->route('investigations.create', ['accident' => $accident->id]);   
      }
        return view('admin.investigation.index', compact('investigation', 'accident'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Accident_Investigations $investigation, Accident $accident)
    {
            return view('admin.investigation.create', compact('accident', 'investigation'));
    
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Accident $accident)
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

        return redirect()->route('investigations.index')->with('success', 'Investigation created successfully.');
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
