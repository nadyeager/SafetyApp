<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // Halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }

   public function indexUser()
{
    $this->authorizeAdmin();

    $users = User::with('sites')
                ->where('role', 'user') 
                ->get();

    return view('admin.users.index', compact('users'));
}


    // Form edit site user
    public function edit(User $user)
    {
        $this->authorizeAdmin();

        $sites = Sites::all();
        return view('admin.users.edit', compact('user', 'sites'));
    }

    // Update site user
   public function update(Request $request, User $user)
{
    $this->authorizeAdmin();

    $request->validate([
        'site_id' => ['required', 'exists:sites,id'],
    ]);

    $user->update([
        'site_id' => $request->site_id,
    ]);

    return redirect()
        ->route('admin.user.edit', $user->id)
        ->with('success', 'Site user berhasil diubah.');
}


    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }
}