<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sites;
use App\Models\Manpower;
use App\Models\Manhours;


class UserDashboardController extends Controller

{
    // public function index()
    // {
    //     return view('user.dashboard'); // buat blade user/dashboard.blade.php
    // }
    public function index()
    {
        //sites per category
        $sitesByCategory = Sites::selectRaw('category, count(*) as total')
        ->groupBy('category')
        ->get();

        $labelsSite = $sitesByCategory->pluck('category')->toArray();
        $dataSite = $sitesByCategory->pluck('total')->toArray();

        //manpower per site
        $manpowerPerSite = Manpower::selectRaw('site_id, sum(total) as total')
            ->groupBy('site_id')
            ->with('site')
            ->get();

            $labelsManpower = $manpowerPerSite->pluck('site.name')->toArray();
            $dataManpower = $manpowerPerSite->pluck('total')->toArray();

            //gender Manpower
            $genderManpower = Manpower::selectRaw('gender, sum(total) as total')
            ->groupBy('gender')
            ->get();

            $labelsGender = $genderManpower->pluck('gender')->toArray();
            $dataGender = $genderManpower->pluck('total')->toArray();

            //manhours per site
   $manhoursPerSite = Manhours::selectRaw('site_id, sum(total_hours) as total')
        ->groupBy('site_id')
        ->with('site')
        ->get();

    $labelsManhours = $manhoursPerSite->pluck('site.name')->toArray();
    $dataManhours = $manhoursPerSite->pluck('total')->toArray();

    //data bulan terakhir
    $latestUpdate = Manhours::latest('updated_at')->first();

    $lastUpdatedMonth =$latestUpdate
    ? \Carbon\Carbon::parse($latestUpdate->updated_at)->format('F Y')
    : '-';

        return view('user.dashboard', compact('labelsSite', 'dataSite',
        'labelsManpower', 'dataManpower',
        'labelsGender', 'dataGender',
        'labelsManhours', 'dataManhours',
        'lastUpdatedMonth',)); // resources/views/admin/dashboard.blade.php
    }
   
}
