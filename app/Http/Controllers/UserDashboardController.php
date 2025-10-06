<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // buat blade user/dashboard.blade.php
    }
}
