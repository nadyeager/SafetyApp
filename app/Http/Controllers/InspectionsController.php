<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Inspections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $inspections = Inspections::with(['site', 'user'])->latest()->paginate(10);
        } else {
            $inspections = Inspections::with(['site', 'user'])
                ->where('site_id', Auth::user()->site_id)
                ->latest()
                ->paginate(10);
        }

        return view('inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inspections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sesuaikan tipe enum jika beda di DB: contoh 'management','routine'
        $request->validate([
            'type' => 'required|in:management,routine',
            'notes' => 'nullable|string|max:2000',
            'date' => 'required|date',
            'status' => 'required|in:open,close',
        ]);

        Inspections::create([
            'site_id' => Auth::user()->site_id, // ambil site dari user
            'user_id' => Auth::id(),
            'type' => $request->type,
            'notes' => $request->notes,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('inspections.index')->with('success', 'Inspection created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspections $inspection)
    {
        // hanya admin atau user yang punya site sama yang boleh edit
        if (Auth::user()->role !== 'admin' && $inspection->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        return view('inspections.edit', compact('inspection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspections $inspection)
    {
        if (Auth::user()->role !== 'admin' && $inspection->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:management,routine',
            'notes' => 'nullable|string|max:2000',
            'date' => 'required|date',
            'status' => 'required|in:open,close',
        ]);

        $inspection->update([
            'type' => $request->type,
            'notes' => $request->notes,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('inspections.index')->with('success', 'Inspection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspections $inspection)
    {
        if (Auth::user()->role !== 'admin' && $inspection->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $inspection->delete(); // gunakan soft delete jika migration menyertakan softDeletes

        return redirect()->route('inspections.index')->with('success', 'Inspection deleted successfully.');
    }
}
