<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Accident_Investigations;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        if (Auth::user()->role === 'admin') {
            $accidents = Accident::with(['site', 'user'])->latest()->paginate(10);
        } else {
           
            $accidents = Accident::with(['site', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
        }

        return view('accidents.index', compact('accidents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accidents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Accident $accident)
    {
        $request->validate([
            'type' => 'required|in:fatal,major,minor,traffic,non-work',
            'description' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|in:open,close',
        ]);

        Accident::create([
            'site_id' => Auth::user()->site_id, // otomatis ambil site user
            'user_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('accidents.index')->with('success', 'Accident created successfully.');
    }

    public function show(Accident $accident)
    {
        $investigation = $accident->investigation;
        return view('accidents.detail', compact('accident', 'investigation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accident $accident)
    {
       
        if (Auth::user()->role !== 'admin' && $accident->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        return view('accidents.edit', compact('accident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accident $accident)
    {
        if (Auth::user()->role !== 'admin' && $accident->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:fatal,major,minor,traffic,non-work',
            'description' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|in:open,close',
        ]);

        $accident->update([
            'type' => $request->type,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('accidents.index')->with('success', 'Accident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accident $accident)
    {
        if (Auth::user()->role !== 'admin' && $accident->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $accident->delete();

        return redirect()->route('accidents.index')->with('success', 'Accident deleted successfully.');
    }
}
