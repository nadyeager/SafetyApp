<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $trainings = Trainings::with(['site', 'user'])->latest()->paginate(10);
        } else {
            $trainings = Trainings::with(['site', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
        }

        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jika admin, kirim list sites untuk dropdown; kalau bukan, frontend akan ambil site dari user
        $sites = [];
        if (Auth::user()->role === 'admin') {
            $sites = Sites::orderBy('name')->pluck('name', 'id');
        }

        return view('trainings.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // rules dasar
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|in:mandatory,non-mandatory',
            'provider' => 'nullable|string|max:255',
            'expired_date' => 'nullable|date',
        ];

        // jika admin, izinkan memilih site_id, cek exists
        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
        }

        $validated = $request->validate($rules);

        // tentukan site_id: admin dari request, user dari auth()->user()->site_id
        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : Auth::user()->site_id;

        Trainings::create([
            'site_id' => $siteId,
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'provider' => $validated['provider'] ?? null,
            'expired_date' => $validated['expired_date'] ?? null,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainings $training)
    {
        // otorisasi sederhana: admin boleh, selain admin hanya boleh jika site_id sama
        if (Auth::user()->role !== 'admin' && $training->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $sites = [];
        if (Auth::user()->role === 'admin') {
            $sites = Sites::orderBy('name')->pluck('name', 'id');
        }

        return view('trainings.edit', compact('training', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainings $training)
    {
        if (Auth::user()->role !== 'admin' && $training->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|in:mandatory,non-mandatory',
            'provider' => 'nullable|string|max:255',
            'expired_date' => 'nullable|date',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['site_id'] = 'required|exists:sites,id';
        }

        $validated = $request->validate($rules);

        $siteId = Auth::user()->role === 'admin' ? $validated['site_id'] : $training->site_id;

        $training->update([
            'site_id' => $siteId,
            'name' => $validated['name'],
            'type' => $validated['type'],
            'provider' => $validated['provider'] ?? null,
            'expired_date' => $validated['expired_date'] ?? null,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainings $training)
    {
        if (Auth::user()->role !== 'admin' && $training->site_id !== Auth::user()->site_id) {
            abort(403);
        }

        $training->delete(); // jika kamu ingin soft delete, pastikan migration menggunakan softDeletes

        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
