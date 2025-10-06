<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // buat blade admin/dashboard.blade.php
    }
}
