<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sites;
use App\Models\Manpower;
use App\Models\Manhours;
use App\Models\Accident;
use App\Models\Accident_Investigations;
use App\Models\Inspections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // Halaman dashboard admin
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

        return view('admin.dashboard', compact('labelsSite', 'dataSite',
        'labelsManpower', 'dataManpower',
        'labelsGender', 'dataGender',
        'labelsManhours', 'dataManhours',
        'lastUpdatedMonth',)); // resources/views/admin/dashboard.blade.php
    }

    // Daftar user
   public function indexUser()
{
    $this->authorizeAdmin();

    $users = User::with('site')
                ->where('role', 'user') 
                ->get();

    return view('admin.users.index', compact('users'));
}

// Daftar accident
public function indexAccident() {

    $accidents = Accident::with(['site', 'user'])->latest()->paginate(10);
    return view('admin.accident.index', compact('accidents'));
}

public function filteredAccident(Request $request) {
    
    $query = Accident::query();

    if ($request->status)  {
         $query->where('status', $request->status);
}

if ($request->type) {
    $query->where('type', $request->type);
}

$accidents = $query->get();

return view('admin.accident.index', compact('accidents'));
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

    //accident show
    public function show(Accident $accident)
    {
        $accident_investigations = Accident_Investigations::where('accident_id', $accident->id)->get();
        return view('admin.accident.show', compact('accident', 'accident_investigations'));
    }

    //index inspection admin

    public function indexInspection(Request $request, Inspections $inspection) {

        $month = $request->input('month', now()->format('Y-m'));
        $monthNumber = date('m', strtotime($month));
 
        $managementOpen = Inspections::type('management')->status('open')->whereMonth('date', $monthNumber)->count();
        $managementClose = Inspections::type('management')->status('close')->whereMonth('date', $monthNumber)->count();
        $routineOpen = Inspections::type('routine')->status('open')->whereMonth('date', $monthNumber)->count();
        $routineClose = Inspections::type('routine')->status('close')->whereMonth('date', $monthNumber)->count();

        $inspection = Inspections::with(['site', 'user'])
        ->whereMonth('date', $monthNumber)
        ->latest()
        ->get();

        return view('admin.inspection.index', compact('inspection', 'managementOpen', 'managementClose', 'routineOpen', 'routineClose'));
    }

    public function showInspection(Inspections $inspection) {
        return view('admin.inspection.show', compact('inspection'));
    }

    public function updateInspection(Request $request, Inspections $inspection) {
        $request->validate([
            'type' => 'required|in:management,routine',
            'notes' => 'required|string',
            'corrective_action' => 'required|string',
            'date' => 'required|date',
            'status'=> 'required|in:open,close',
            'close_date' => 'required|date',
        ]);

        $inspection->update([
            'type' => $request->type,
            'notes' => $request->notes,
            'corrective_action' => $request->corrective_action,
            'date' => $request->date,
            'status' => $request->status,
            'close_date' => $request->close_date,
            
        ]);

        return redirect()->route('admin.inspection.index')->with('success', 'Inspection updated successfully.');
    }

}