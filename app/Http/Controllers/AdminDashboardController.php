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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    // Halaman dashboard admin
public function index(Request $request)
{
    $month = $request->input('month', now()->format('Y-m'));
    $monthNumber = date('m', strtotime($month));
    $yearNumber = date('Y', strtotime($month));

    // Site per kategori
    $siteByCategory = sites::selectRaw('category, COUNT(*) as total')
        ->whereMonth('created_at', $monthNumber)
        ->whereYear('created_at', $yearNumber)
        ->groupBy('category')
        ->get();

    $labelsSiteCategory = $siteByCategory->pluck('category')->toArray();
    $dataSiteCategory = $siteByCategory->pluck('total')->toArray();

    // Total manpower
    $manpowerBySites = manpower::selectRaw('site_id, type, SUM(total) as total')
        ->whereMonth('created_at', $monthNumber)
        ->whereYear('created_at', $yearNumber)
        ->groupBy('site_id', 'type')
        ->with('site')
        ->get();

    $labelsManpower = $manpowerBySites->pluck('site.name')->unique()->toArray();
    $dataManpowerOrganik = $manpowerBySites->where('type', 'organik')->pluck('total')->toArray();
    $dataManpowerPartner = $manpowerBySites->where('type', 'partner')->pluck('total')->toArray();

    // Gender manpower
    $genderBySites = manpower::selectRaw('gender, type, SUM(total) as total')
        ->whereMonth('created_at', $monthNumber)
        ->whereYear('created_at', $yearNumber)
        ->groupBy('gender', 'type')
        ->get();

    $labelsGender = $genderBySites->pluck('gender')->unique()->toArray();
    $dataGenderOrganik = $genderBySites->where('type', 'organik')->pluck('total')->toArray();
    $dataGenderPartner = $genderBySites->where('type', 'partner')->pluck('total')->toArray();

    // Manhours per site
   $manhoursBySites = manhours::selectRaw('site_id, type, SUM(total_hours) as total_hours')
    ->whereMonth('created_at', $monthNumber)
    ->whereYear('created_at', $yearNumber)
    ->groupBy('site_id', 'type')
    ->with('site')
    ->get();


$labelsManhours = array_values($manhoursBySites->pluck('site.name')->unique()->toArray());
$dataManhoursOrganik = $manhoursBySites
    ->where('type', 'organik')
    ->pluck('total_hours', 'site.name'); 
$dataManhoursPartner = $manhoursBySites
    ->where('type', 'partner')
    ->pluck('total_hours', 'site.name');



    return view('admin.dashboard', compact(
        'labelsSiteCategory', 'dataSiteCategory',
        'labelsManpower', 'dataManpowerOrganik', 'dataManpowerPartner',
        'labelsGender', 'dataGenderOrganik', 'dataGenderPartner',
        'labelsManhours', 'dataManhoursOrganik', 'dataManhoursPartner', 'month','monthNumber','yearNumber'
    ));
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

    $accidents = Accident::with(['site', 'user'])
    ->latest()
    ->paginate(10);

    $stats = $this->getAccidentStats();

   $sec = $this->getAccidentsSec();
    

    return view('admin.accident.index', array_merge ( compact('accidents'), $stats, $sec));
}

private function getAccidentStats() {
    $accidents = Accident::all();
    $investigation = Accident_Investigations::count();

    return [
        'totalAccidents' => $accidents->count(),
        'totalWorkAccidents' => $accidents->whereIn('type', ['Fatality', 'Major injury', 'Minor injury'])->count(),
        'totalTrafficAccidents' => $accidents->where('category', 'traffic accident')->count(),
        'totalNonWorkAccidents' => $accidents->whereIn('type', ['Property damage', 'Non Work Accident', 'Occupational disease'])->count(),
        'totalInvestigation' => $investigation,
        'totalClosedAccidents' => $accidents->where('status', 'close')->count(),
        'totalOpenedAccidents' => $accidents->where('status', 'open')->count(),
    ];
}

private function getAccidentsSec() {
    $accidents = Accident::with(['site', 'user'])->get();

    $orderedtypes = ['Fatality', 'Major injury', 'Minor injury'];

    $orderedtypes2 = ['Property damage', 'Non Work Accident', 'Occupational disease'];

    return [
        'workAccidents' => $accidents
        ->whereIn ('type', $orderedtypes)
        ->groupBy('type')
        ->sortBy(function ($group, $key) use ($orderedtypes) {
            return array_search($key, $orderedtypes);
        }),
        
        'trafficAccidents' => $accidents
        ->where('category', 'traffic accident'),
        

        'nonWorkAccidents' => $accidents
        ->whereIn('type', $orderedtypes2)
        ->groupBy('type')
        ->sortBy(function ($group, $key) use ($orderedtypes2) {
            return array_search($key, $orderedtypes2);
        }),
        
    ];
}

public function filteredAccident(Request $request) {
    $status = $request->query('status');
    $category = $request->query('category');

    $accidents = Accident::with(['site', 'user'])
        ->when($status, fn($q) => $q->where('status', $status ))
        ->when($category, fn($q) => $q->where('category', $category))
        ->get();

    // Urutan yang kamu inginkan
    $orderedTypes = ['Fatality', 'Major injury', 'Minor injury', 'Traffic Accident', 'Non Work Accident'];
    $orderedTypes2 = ['Property damage', 'Non Work Accident', 'Occupational disease'];

    // === Group + Sort Berdasarkan Urutan ===
    $workAccidents = $accidents
        ->where('category', 'work accident')
        ->groupBy('type')
        ->sortBy(function ($group, $key) use ($orderedTypes) {
            return array_search($key, $orderedTypes);
        });

    $trafficAccidents = $accidents
        ->where('category', 'traffic accident')
        ->sortBy(function ($item) {
            return $item->date; // atau bisa diurutkan pakai field lain
        });

    $nonWorkAccidents = $accidents
        ->where('category', 'non-work accident')
        ->groupBy('type')
        ->sortBy(function ($group, $key) use ($orderedTypes2) {
            return array_search($key, $orderedTypes2);
        });

    // === Statistik ===
    $totalAccidents = $accidents->count();
    $totalWorkAccidents = $accidents->where('category', 'work accident')->count();
    $totalTrafficAccidents = $accidents->where('category', 'traffic accident')->count();
    $totalNonWorkAccidents = $accidents->where('category', 'non-work accident')->count();
    $totalInvestigation = Accident_Investigations::count();
    $totalClosedAccidents = $accidents->where('status', 'close')->count();
    $totalOpenedAccidents = $accidents->where('status', 'open')->count();

    return view('admin.accident.index', compact(
        'accidents',
        'totalAccidents',
        'totalWorkAccidents',
        'totalTrafficAccidents',
        'totalNonWorkAccidents',
        'totalInvestigation',
        'totalClosedAccidents',
        'totalOpenedAccidents',
        'workAccidents',
        'trafficAccidents',
        'nonWorkAccidents'
    ));
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

        $inspections = Inspections::with(['site', 'user'])
        ->whereMonth('date', $monthNumber)
        ->get();

        $management = $inspections->where('type', 'management');
        $routine = $inspections->where('type', 'routine');
 
        $managementOpen = $management->where('status', 'open')->count();
        $managementClose = $management->where('status', 'close')->count();
        $routineOpen = $routine->where('status', 'open')->count();
        $routineClose = $routine->where('status', 'close')->count();


        return view('admin.inspection.index', 
        compact('inspections', 'management', 'routine', 'managementOpen', 'managementClose', 'routineOpen', 'routineClose'));
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

    public function indexAssessment(Request $request, Assessments $assessments) {

        $assessments = Assessments::with(['site', 'user'])->latest()->paginate(10);

        $query = Assessments::query();

        if($request->type) {
            $query->where('type', $request->type);
        }

        $assessments = $query->get();
        

        return view('admin.assessment.index', compact('assessments'));

    }

    public function indexManhour() {
        return view('admin.manhour.index');
    }

    public function indexManpower() {
        return view('admin.manpower.index');
    }

    public function indexSafetyActivity() {

        $data = SafetyActivities::select('type', DB::raw('count(*) as total'))
        ->groupBy('type')
        ->get();

        $labels = [
            'safety_talk' => 'Safety Talk',
            'p5m' => 'P5M',
            'meeting' => 'Safety Meeting',
            'campaign' => 'Safety Campaign',
        ];

        return view('admin.safetyActivity.index', compact('data', 'labels'));
    }

//     public function indexTraining(Request $request, Trainings $training) {

//         $training = Trainings::with(['site', 'user'])->get();

       
//         $total_mandatory = $training->where('type', 'mandatory')->count();
//         $total_non_mandatory = $training->where('type', 'non-mandatory')->count();
      
//         $mandatory = $training->where('type', 'mandatory');

//         $non_mandatory = $training->where('type', 'non-mandatory');

//         return view('admin.training.index', compact('mandatory', 'non_mandatory', 'total_mandatory', 'total_non_mandatory', 'training'));
//     }

//     public function filteredTraining(Request $request) {
//         $type = $request->query('type');

//         $training = Trainings::with(['site', 'user'])
//             ->when($type, fn($q) => $q->where('type', $type))
//             ->get();

//         $total_mandatory = $training->where('type', 'mandatory')->count();
//         $total_non_mandatory = $training->where('type', 'non-mandatory')->count();

//         $mandatory = $training->where('type', 'mandatory');

//         $non_mandatory = $training->where('type', 'non-mandatory');

//         return view('admin.training.index', compact(
//             'training',
//             'mandatory',
//             'non_mandatory',
//             'total_mandatory',
//             'total_non_mandatory'
//         ));
//     }

//     public function indexCertification(Request $request, Certifications $certification) {

//         $certification = Certifications::with(['site', 'user'])->get();

      
//             $total_mandatory = $certification->where('type', 'mandatory')->count();
//             $total_non_mandatory = $certification->where('type', 'non-mandatory')->count();

//            $mandatory = $certification->where('type', 'mandatory');

//               $non_mandatory = $certification->where('type', 'non-mandatory');

//         return view('admin.certification.index', compact( 'mandatory', 'non_mandatory', 'total_mandatory', 'total_non_mandatory', 'certification'));
//     }

//     public function filteredCertification(Request $request) {
//         $type = $request->query('type');

//         $certification = Certifications::with(['site', 'user'])
//             ->when($type, fn($q) => $q->where('type', $type))
//             ->get();

//         $total_mandatory = $certification->where('type', 'mandatory')->count();
//         $total_non_mandatory = $certification->where('type', 'non-mandatory')->count();

//         $mandatory = $certification->where('type', 'mandatory');

//         $non_mandatory = $certification->where('type', 'non-mandatory');

//         return view('admin.certification.index', compact(
//             'certification',
//             'mandatory',
//             'non_mandatory',
//             'total_mandatory',
//             'total_non_mandatory'
//         ));
//     }

// }

private function getSummaryData($model, $typeFilter = null) {

    $query = $model::with(['site', 'user']);
    if ($typeFilter) {
        $query->where('type', $typeFilter);
    }

    $data = $query->get();

    $expiringSoon = $model::where('expired_date', [now(), now()->addDays(30)])->get();
    $expired = $model::where('expired_date', '<', now())->get();

    return [
        'data' => $data,
        'mandatory' => $data->where('type', 'mandatory'),
        'non_mandatory' => $data->where('type', 'non-mandatory'),
        'total_mandatory' => $data->where('type', 'mandatory')->count(),
        'total_non_mandatory' => $data->where('type', 'non-mandatory')->count(),
        'expiring_soon' => $expiringSoon->count(),
        'expired' => $expired->count(),
    ];

}

public function indexTraining(Request $request) {
    $summary = $this->getSummaryData(Trainings::class);

    return view('admin.training.index', [
        'training' => $summary['data'],
        'mandatory' => $summary['mandatory'],
        'non_mandatory' => $summary['non_mandatory'],
        'total_mandatory' => $summary['total_mandatory'],
        'total_non_mandatory' => $summary['total_non_mandatory'],
    ]);
}

public function filteredTraining(Request $request) {
    $summary = $this->getSummaryData(Trainings::class, $request->query('type'));

    return view('admin.training.index', [
        'training' => $summary['data'],
        'mandatory' => $summary['mandatory'],
        'non_mandatory' => $summary['non_mandatory'],
        'total_mandatory' => $summary['total_mandatory'],
        'total_non_mandatory' => $summary['total_non_mandatory'],
    ]);
   
}

public function indexCertification(Request $request) {
    $summary = $this->getSummaryData(Certifications::class);


    return view('admin.certification.index', [
        'certification' => $summary['data'],
        'mandatory' => $summary['mandatory'],
        'non_mandatory' => $summary['non_mandatory'],
        'total_mandatory' => $summary['total_mandatory'],
        'total_non_mandatory' => $summary['total_non_mandatory'],
        'expiring_soon' => $summary['expiring_soon'],
        'expired' => $summary['expired'],
    ]);
}

public function filteredCertification(Request $request) {
    $summary = $this->getSummaryData(Certifications::class, $request->query('type'));

    return view('admin.certification.index', [
        'certification' => $summary['data'],
        'mandatory' => $summary['mandatory'],
        'non_mandatory' => $summary['non_mandatory'],
        'total_mandatory' => $summary['total_mandatory'],
        'total_non_mandatory' => $summary['total_non_mandatory'],
        'expiring_soon' => $summary['expiring_soon'],
        'expired' => $summary['expired'],

    ]);
   
}
}
