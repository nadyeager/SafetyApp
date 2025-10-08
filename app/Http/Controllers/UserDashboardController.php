<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sites;

class UserDashboardController extends Controller

{
    public function index()
    {
        return view('user.dashboard'); // buat blade user/dashboard.blade.php
    }

   
}
