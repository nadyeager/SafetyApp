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

public function editUser(User $user) {

    $sites = Sites::all();
    return view('admin.users.edit', compact('user', 'sites'));
}
    

    // Update site user
   public function updateUser(Request $request, User $user)
{
    $this->authorizeAdmin();

    $request->validate([
        'site_id' => ['required', 'exists:sites,id'],
    ]);

    $user->update([
        'site_id' => $request->site_id,
    ]);

    return redirect()
        ->route('admin.user.index', $user->id)
        ->with('success', 'Site user berhasil diubah.');
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
        'totalWorkAccidents' => $accidents->whereIn('type', ['Fatality', 'Mayor injury', 'Minor injury'])->count(),
        'totalTrafficAccidents' => $accidents->where('category', 'traffic accident')->count(),
        'totalNonWorkAccidents' => $accidents->whereIn('type', ['Property damage', 'Non Work Accident', 'Occupational disease'])->count(),
        'totalInvestigation' => $investigation,
        'totalClosedAccidents' => $accidents->where('status', 'close')->count(),
        'totalOpenedAccidents' => $accidents->where('status', 'open')->count(),
    ];
}

private function getAccidentsSec() {
    $accidents = Accident::with(['site', 'user'])->get();

    $orderedtypes = ['Fatality', 'Mayor injury', 'Minor injury'];

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
    $orderedTypes = ['Fatality', 'Mayor injury', 'Minor injury', 'Traffic Accident', 'Non Work Accident'];
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

public function editAccident(Accident $accident) {
    return view('admin.accident.update', compact('accident'));
}

public function updateAccident(Request $request, Accident $accident)
{
    // Validasi
    $request->validate([
        'category' => 'required|in:work accident,traffic accident,non-work accident',
        'type' => $request->category === 'traffic accident' ? 'nullable' : 'required',
        'description' => 'required|string',
        'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10000',
        
    ]);

    // Tangani file
   $filePath = $accident->file; // default file lama

if ($request->hasFile('file')) {
    $filePath = $request->file('file')->store('accidents_file', 'public');
}



$accident->update([
    'category' => $request->category,
    'type' => $request->type,
    'description' => $request->description,
    'file' => $filePath,
]);

    // Redirect ke index
    return redirect()->route('admin.accident.index')
        ->with('success', 'Accident updated successfully.');
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
    
    public function updateStatus(Request $request, $id)
{
    $accident = Accident::findOrFail($id);

    // Ubah statusnya
    $accident->status = $request->status;
    $accident->save();

    return response()->json(['success' => true]);
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

    public function updateNotes(Request $request, $id)
{
    $request->validate([
        'notes' => 'nullable|string|max:2000',
    ]);

    $inspection = \App\Models\Inspections::findOrFail($id);
    $inspection->notes = $request->notes;
    $inspection->save();

    return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
}

    public function editInspection(Inspections $inspection) {
        return view('admin.inspection.update', compact('inspection'));            
    }

    public function updateInspection(Request $request, Inspections $inspection) {
        $request->validate([
            'type' => 'required|in:management,routine',
            'corrective_action' => 'required|string',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10000',
        ]);

        $filePath = $inspection->file; // default file lama

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('inspection_files', 'public');
        }

        $inspection->update([
            'type' => $request->type,
            'corrective_action' => $request->corrective_action,
            'date' => $request->date,
            'file' => $filePath,
            
        ]);

        return redirect()->route('admin.inspection.index')->with('success', 'Inspection updated successfully.');
    }

    public function updateStatusInspection(Request $request, $id)
    {
         $inspection = Inspections::findOrFail($id);

    // Ubah statusnya
    $inspection->status = $request->status;
    $inspection->save();

    return response()->json(['success' => true]);
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

    public function editAssessment(Assessments $assessment) {
        return view('admin.assessment.update', compact('assessment'));
    }

    public function updateAssessment(Request $request, Assessments $assessment) {
        $request->validate([
            'type' => 'required|in:SMK3,SMKP,AGC,MKA,CSMS,Others',
            'other_name' => 'required_if:name,Others|string|max:255',
            'score' => 'required|numeric|min:0|max:100',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10000',
        ]);

        $filePath = $assessment->file; // default file lama

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assessment_files', 'public');
        }

        $assessment->update([
            'type' => $request->type === 'Others' ? $request->other_name : $request->type,
            'score' => $request->score,
            'date' => $request->date,
            'file' => $filePath,
        ]);



        return redirect()->route('admin.assessment.index')->with('success', 'Assessment updated successfully.');
    }

    public function showAssessment(Assessments $assessment) {
        
        return view('admin.assessment.show', compact('assessment'));
    }
    public function indexManhour() {

        $manhour = Manhours::with('site')->get(); 

        return view('admin.manhour.index', compact('manhour'));
    }

    public function editManhour(Manhours $manhour) {
        return view('admin.manhour.update', compact('manhour'));            
    }

    public function updateManhour(Request $request, Manhours $manhour) {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'total_hours' => 'required|numeric|min:0',
'month' => 'required|integer|between:1,12',
'year' => 'required|integer|min:1900|max:2100',

        ]);

        $manhour->update([
            'type' => $request->type,
            'total_hours' => $request->total_hours,
            'month' => $request->month,
            'year' => $request->year,
        ]);
        return redirect()->route('admin.manhour.index')->with('success', 'Manhour updated successfully.');
    }

    public function showManhour(Manhours $manhour) {
        
        return view('admin.manhour.show', compact('manhour'));
    }

    public function indexManpower() {

        $manpower = Manpower::with('site')->get();

        return view('admin.manpower.index', compact('manpower'));
    }

    public function editManpower(Manpower $manpower) {
        return view('admin.manpower.update', compact('manpower'));            
    }

    public function updateManpower(Request $request, Manpower $manpower) {
        $request->validate([
            'type' => 'required|in:organik,partner',
            'gender' => 'required|in:male,female',
            'total' => 'required|numeric|min:0',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900|max:2100',
        ]);

        $manpower->update([
            'type' => $request->type,
            'gender' => $request->gender,   
            'total' => $request->total,
            'month' => $request->month,
            'year' => $request->year,
        ]);
        return redirect()->route('admin.manpower.index')->with('success', 'Manpower updated successfully.');
    }

    public function showManpower(Manpower $manpower) {
        
        return view('admin.manpower.show', compact('manpower'));
    }

    public function indexSafetyActivity() {

        $safetyActivity = SafetyActivities::with(['site', 'user'])->get();

        return view('admin.safetyActivity.index', compact('safetyActivity'));
    }


    public function showSafetyActivity(SafetyActivities $safetyActivity) {
        
        return view('admin.safetyActivity.show', compact('safetyActivity'));
    }
    public function editSafetyActivity(SafetyActivities $safetyActivity) {
        return view('admin.safetyActivity.update', compact('safetyActivity'));            
    }

    public function updateSafetyActivity(Request $request, SafetyActivities $safetyActivity) {
        $request->validate([
            'type' => 'required|in:safety_talk,p5m,meeting,campaign,Others',
            'other_type' => 'required_if:type,Others|string|max:255',
            'frequency' => 'required|in:daily,weekly,monthly',
            'date' => 'required|date',
            'notes' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10000',
        ]);

        $filePath = $safetyActivity->file; // default file lama

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('safety_activity_files', 'public');
        }
          
        $safetyActivity->update([
            'type' => $request->type === 'Others' ? $request->other_type : $request->type,
            'frequency' => $request->frequency,
            'date' => $request->date,
            'notes' => $request->notes,
            'file' => $filePath,

        ]);
        return redirect()->route('admin.safetyActivity.index')->with('success', 'Safety Activity updated successfully.');
    }

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

public function editTraining(Trainings $training) {
    return view('admin.training.update', compact('training'));            

}
public function updateTraining(Request $request, Trainings $training) {
    $request->validate([
        'name' => 'required|in:Training POP,Training POM,Training POU,Others',
        'other_name' => 'required_if:name,Others|string|max:255',
        'type' => 'required|in:mandatory,non-mandatory',
        'provider' => 'nullable|string',
        'expired_date' => 'nullable|date',
    ]);

    $training->update([
        'name' => $request->name === 'Others' ? $request->other_name : $request->name,
        'type' => $request->type,
        'provider' => $request->provider,
        'expired_date' => $request->expired_date,
    ]);
    return redirect()->route('admin.training.index')->with('success', 'Training updated successfully.');
}

public function showTraining(Trainings $training) {

    return view('admin.training.show', compact('training'));
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

public function editCertification(Certifications $certification) {
    return view('admin.certification.update', compact('certification'));            

}

public function updateCertification(Request $request, Certifications $certification) {
    $request->validate([
      'name' => 'required|in:Certification AK3U,Certification AK3 Listrik,Certification First Aid,Certification Accident Investigation,Others',
            'other_name' => 'required_if:name,Others|string|max:255',
        'type' => 'required|in:mandatory,non-mandatory',
        'provider' => 'nullable|string',
        'expired_date' => 'nullable|date',
    ]);

    $certification->update([
         'name' => $request->name === 'Others' ? $request->other_name : $request->name,
        'type' => $request->type,
        'provider' => $request->provider,
        'expired_date' => $request->expired_date,
    ]);
    return redirect()->route('admin.certification.index')->with('success', 'Certification updated successfully.');
}

public function showCertification(Certifications $certification) {

    return view('admin.certification.show', compact('certification'));
}
}