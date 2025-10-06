<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            // belum login -> ke login
            return redirect()->route('login');
        }

        if ($user->role !== 'admin') {
            // non-admin ditolak; redirect ke user dashboard
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak: hanya admin.');
        }

        return $next($request);
    }
}
