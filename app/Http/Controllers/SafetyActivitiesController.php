<?php

namespace App\Http\Controllers;

use App\Models\SafetyActivities;
use App\Models\Sites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafetyActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $safetyActivities = SafetyActivities::with(['site','user'])->latest()->paginate(10);
        } else {
            $safetyActivities = SafetyActivities::with(['site','user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
        }

        return view('safety-activities.index', compact('safetyActivities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // tipe sesuai enum di migration
        $types = ['safety_talk','p5m','meeting','campaign'];

        $sites = [];
        $users = [];

        if (Auth::user()->role === 'admin') {
            $sites = Sites::orderBy('name')->pluck('name','id')->toArray();
            $users = User::orderBy('name')->pluck('name','id')->toArray();
        }

        return view('safety-activities.create', compact('types','sites','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|in:safety_talk,p5m,meeting,campaign',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
            $rules['user_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);

        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : Auth::user()->site_id;
        $userId = Auth::user()->role === 'admin' ? $validated['user_id'] : Auth::id();

        SafetyActivities::create([
            'site_id' => $siteId,
            'user_id' => $userId,
            'type' => $validated['type'],
            'date' => $validated['date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('safety-activities.index')->with('success', 'Safety activity created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyActivities $safetyActivity)
    {
        if (Auth::user()->role !== 'admin' && $safetyActivity->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $types = ['safety_talk','p5m','meeting','campaign'];
        $sites = [];
        $users = [];

        if (Auth::user()->role === 'admin') {
            $sites = Sites::orderBy('name')->pluck('name','id')->toArray();
            $users = User::orderBy('name')->pluck('name','id')->toArray();
        }

        return view('safety-activities.edit', compact('safetyActivity','types','sites','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SafetyActivities $safetyActivity)
    {
        if (Auth::user()->role !== 'admin' && $safetyActivity->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $rules = [
            'type' => 'required|in:safety_talk,p5m,meeting,campaign',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
            $rules['user_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);

        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : $safetyActivity->site_id;
        $userId = Auth::user()->role === 'admin' ? $validated['user_id'] : $safetyActivity->user_id;

        $safetyActivity->update([
            'site_id' => $siteId,
            'user_id' => $userId,
            'type' => $validated['type'],
            'date' => $validated['date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('safety-activities.index')->with('success', 'Safety activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyActivities $safetyActivity)
    {
        if (Auth::user()->role !== 'admin' && $safetyActivity->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $safetyActivity->delete();

        return redirect()->route('safety-activities.index')->with('success', 'Safety activity deleted successfully.');
    }
}
