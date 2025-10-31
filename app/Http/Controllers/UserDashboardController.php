<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sites;
use App\Models\Manpower;
use App\Models\Manhours;
use App\Models\Accident;
use App\Models\Accident_Investigations;
use App\Models\Inspections;
use App\Models\Trainings;
use App\Models\Certifications;
use App\Models\Assessments;
use App\Models\SafetyActivities;
use Illuminate\Http\Request;


class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Ambil bulan dari query, default bulan sekarang
        $month = $request->input('month', now()->format('Y-m'));
        $monthNumber = date('m', strtotime($month));
        $yearNumber = date('Y', strtotime($month));

        // === 1️⃣ Distribusi Site per kategori ===
        $siteByCategory = Sites::selectRaw('category, COUNT(*) as total')
            ->whereMonth('created_at', $monthNumber)
            ->whereYear('created_at', $yearNumber)
            ->groupBy('category')
            ->get();

        $labelsSiteCategory = $siteByCategory->pluck('category')->toArray();
        $dataSiteCategory = $siteByCategory->pluck('total')->toArray();

        // === 2️⃣ Total Manpower ===
        $manpowerBySites = Manpower::selectRaw('site_id, type, SUM(total) as total')
            ->whereMonth('created_at', $monthNumber)
            ->whereYear('created_at', $yearNumber)
            ->groupBy('site_id', 'type')
            ->with('site')
            ->get();

        $labelsManpower = $manpowerBySites->pluck('site.name')->unique()->values()->toArray();
        $dataManpowerOrganik = $manpowerBySites->where('type', 'organik')->pluck('total')->values()->toArray();
        $dataManpowerPartner = $manpowerBySites->where('type', 'partner')->pluck('total')->values()->toArray();

        // === 3️⃣ Gender Manpower ===
        $genderBySites = Manpower::selectRaw('gender, type, SUM(total) as total')
            ->whereMonth('created_at', $monthNumber)
            ->whereYear('created_at', $yearNumber)
            ->groupBy('gender', 'type')
            ->get();

        $labelsGender = $genderBySites->pluck('gender')->unique()->values()->toArray();
        $dataGenderOrganik = $genderBySites->where('type', 'organik')->pluck('total')->values()->toArray();
        $dataGenderPartner = $genderBySites->where('type', 'partner')->pluck('total')->values()->toArray();

        // === 4️⃣ Manhours per Site ===
        $manhoursBySites = Manhours::selectRaw('site_id, type, SUM(total_hours) as total_hours')
            ->whereMonth('created_at', $monthNumber)
            ->whereYear('created_at', $yearNumber)
            ->groupBy('site_id', 'type')
            ->with('site')
            ->get();

        $labelsManhours = $manhoursBySites->pluck('site.name')->unique()->values()->toArray();
        $dataManhoursOrganik = $manhoursBySites
            ->where('type', 'organik')
            ->pluck('total_hours')
            ->values()
            ->toArray();

        $dataManhoursPartner = $manhoursBySites
            ->where('type', 'partner')
            ->pluck('total_hours')
            ->values()
            ->toArray();

        // === Return ke view ===
        return view('user.dashboard', compact(
            'labelsSiteCategory', 'dataSiteCategory',
            'labelsManpower', 'dataManpowerOrganik', 'dataManpowerPartner',
            'labelsGender', 'dataGenderOrganik', 'dataGenderPartner',
            'labelsManhours', 'dataManhoursOrganik', 'dataManhoursPartner',
            'month', 'monthNumber', 'yearNumber'
        ));
    }
}
