<?php

namespace App\Http\Controllers;

use App\Models\Assessments;
use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $assessments = Assessments::with(['site','user'])->latest()->paginate(10);
        } else {
            $assessments = Assessments::with(['site','user'])
                ->where('site_id', Auth::user()->site_id)
                ->latest()
                ->paginate(10);
        }

        return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = [];
        if (Auth::user()->role === 'admin') {
            // untuk admin, kirim list site untuk dropdown
            $sites = Sites::orderBy('name')->pluck('name', 'id');
        }

        return view('assessments.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|in:SMK3,SMKP,AGC,MKA,CSMS',
            'score' => 'required|numeric|between:0,100',
            'date' => 'required|date',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
        }

        $validated = $request->validate($rules);

        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : Auth::user()->site_id;

        Assessments::create([
            'site_id' => $siteId,
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            // simpan sebagai numeric; DB decimal(5,2) akan menyesuaikan
            'score' => number_format((float)$validated['score'], 2, '.', ''),
            'date' => $validated['date'],
        ]);

        return redirect()->route('assessments.index')->with('success', 'Assessment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessments $assessment)
    {
        if (Auth::user()->role !== 'admin' && $assessment->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $sites = [];
        if (Auth::user()->role === 'admin') {
            $sites = Sites::orderBy('name')->pluck('name', 'id');
        }

        return view('assessments.edit', compact('assessment', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessments    $assessment)
    {
        if (Auth::user()->role !== 'admin' && $assessment->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $rules = [
            'type' => 'required|in:SMK3,SMKP,AGC,MKA,CSMS',
            'score' => 'required|numeric|between:0,100',
            'date' => 'required|date',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
        }

        $validated = $request->validate($rules);

        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : $assessment->site_id;

        $assessment->update([
            'site_id' => $siteId,
            'type' => $validated['type'],
            'score' => number_format((float)$validated['score'], 2, '.', ''),
            'date' => $validated['date'],
        ]);

        return redirect()->route('assessments.index')->with('success', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessments $assessment)
    {
        if (Auth::user()->role !== 'admin' && $assessment->site_id !== Auth::user()->site_id) {
            abort(403);
        }   

        $assessment->delete();

        return redirect()->route('assessments.index')->with('success', 'Assessment deleted successfully.');
    }
}
