<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accident_Investigations;
use App\Models\Accident;

class AccidentInvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $investigation = Accident_Investigations::with('accident')->get();
        return view('admin.investigation.index', compact('investigation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Accident $accident, Accident_Investigations $investigation)
    {
          $accident->load('investigation');
        return view('admin.investigation.create', compact('accident', 'investigation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'accident_id' => 'required|exists:accidents,id',
            'investigator' => 'required|string',
            'root_cause' => 'required|string',
            'corrective_action' => 'required|string',
        ]);

        Accident_Investigations::create($request->only([
            'accident_id',
            'investigator',
            'root_cause',
            'corrective_action',
        ]));

        return redirect()->route('investigations.index')->with('success', 'Investigation created.');
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
        return view('admin.investigation.update', compact('investigation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accident_Investigations $investigation)
    {
        $request->validate([
            'investigator' => 'required|string',
            'root_cause' => 'required|string',
            'corrective_action' => 'required|string',
            
        ]);

        $investigation->update([
           'investigator' => $request->investigator,
           'root_cause' => $request->root_cause,
           'corrective_action' => $request->corrective_action
        ]);

        return redirect()->route('investigations.index')->with('success', 'Investigstion Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accident_Investigations $investigation)
    {
        $investigation->delete();
        return redirect()->route('investigations.index')->with('success', 'Investigation deleted successfully!');
    }

      public function updateStatus(Request $request, $id)
{
    $a = Accident::findOrFail($id);
    $a->status = $request->status;
    $a->save();

    return response()->json(['success' => true]);
}

}
