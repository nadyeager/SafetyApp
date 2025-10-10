<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manhours;
use App\Models\Sites;
use Illuminate\Support\Facades\Auth;


class ManhoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $query = Manhours::query();

    // filter untuk user biasa
    if (Auth::user()->role === 'user') {
        $query->where('site_id', Auth::user()->site_id);
    }

    $manhour = $query->paginate(10); // paginate tetap dipakai
    return view('manhours.index', compact('manhour'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manhours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Manhours $manhours)
    {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'total_hours' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
        ]);

        $manhours = Manhours::create([
            'site_id' => Auth::user()->site_id, // otomatis ambil site user
            'type' => $request->type,
            'total_hours' => $request->total_hours,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        return redirect()->route('manhours.index')->with('success', 'Manhours created successfully.');
        
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
    public function edit(Manhours $manhour)
    {
        return view('manhours.edit', compact('manhour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manhours $manhour)
    {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'total_hours' => 'required|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
        ]);

        $manhour->update([
            'type' => $request->type,
            'total_hours' => $request->total_hours,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        return redirect()->route('manhours.index')->with('success', 'Manhours updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manhours $manhour)
    {
        $manhour->delete();
        return redirect()->route('manhours.index')->with('success', 'Manhours deleted successfully.');
    }
}
