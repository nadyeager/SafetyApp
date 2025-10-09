<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;
use App\Models\Accident_Investigations;

class Accident_InvestigationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investigation = Accident_Investigations::paginate(10);
        return view('investigations.index', compact('investigation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Accident $accident)
    {
        
        return view('accidents.detail', compact('accident'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $request->validate([
        'accident_id' => 'required|exists:accidents,id',
        'investigator' => 'required|string|max:255',
        'root_cause' => 'required|string',
        'corrective_action' => 'required|string',
        'status' => 'required|in:open,close',
    ]);

    Accident_Investigations::create($request->all());

    // ✅ Balik ke halaman detail accident, bukan index investigations
    return redirect()->route('accidents.show', $request->accident_id)
        ->with('success', 'Accident Investigation created successfully.');
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
    public function edit(Accident_Investigations $investigation)
    {
        return view('investigations.edit', compact('investigation'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Accident_Investigations $investigation)
{
    $request->validate([
        'investigator' => 'required|string|max:255',
        'root_cause' => 'required|string',
        'corrective_action' => 'required|string',
        'status' => 'required|in:open,close',
    ]);

    $investigation->update($request->all());

    return redirect()
        ->route('accidents.show', $investigation->accident_id)
        ->with('success', 'Investigation updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accident_Investigations $investigation)
    {
       
    $investigation->delete();

        return redirect()->route('accidents.index')
            ->with('success', 'Accident Investigation deleted successfully.');
    }
}
