<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certifications;

class CertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certification = Certifications::with(['site', 'user'])->get();
        return view('certifications.index', compact('certification'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Certifications $certification)
    {
        return view('certifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|in:Certification AK3U,Certification AK3 Listrik,Certification First Aid,Certification Accident Investigation,Others',
            'other_name' => 'required_if:name,Others|string|max:255',
            'type' => 'required|in:mandatory,non-mandatory',
            'provider' => 'nullable|string|max:255',
            'expired_date' => 'nullable|date',
        ]);

        Certifications::create([
            'site_id' => auth()->user()->site_id,
            'user_id' => auth()->id(),
            'name' => $request->name === 'Others' ? $request->other_name : $request->name,
            'type' => $request->type,
            'provider' => $request->provider,
            'expired_date' => $request->expired_date,
        ]);
        return redirect()->route('certifications.index')
            ->with('success', 'Certification created successfully.');
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
