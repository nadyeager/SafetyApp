<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manpower;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $query = Manpower::query();
    
    if (Auth::user()->role === 'user') {
        $query->where('site_id', Auth::user()->site_id);
    }

    $manpower = $query->paginate(10); 
    return view('manpower.index', compact('manpower'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manpowers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Manpower $manpower)
    {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'gender' => 'required|in:male,female',
            'total' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
        ]);

        $manpower = Manpower::create([
            'site_id' => Auth::user()->site_id, // otomatis ambil site user
            'type' => $request->type,
            'gender' => $request->gender,
            'total' => $request->total,
            'month' => $request->month,
            'year' => $request->year,
        ]);
        
        return redirect()->route('manpowers.index')->with('success', 'Manpowers created succsessfully.');
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
    public function edit(Manpower $manpower)
    {
        return view('manpowers.edit', compact('manpower'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manpower $manpower)
    {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'gender' => 'required|in:male,female',
            'total' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
        ]);

        $manpower->update([
            'type' => $request->type,
            'gender' => $request->gender,
            'total' => $request->total,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        return redirect()->route('manpowers.index')->with('success', 'Manpower updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manpower $manpower)
    {
        $manpower->delete();
        return redirect()->route('manpowers.index')->with('success', 'Manpower deleted successfully.');
    }
}
