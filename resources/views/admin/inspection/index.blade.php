@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold mb-4"><span class="text-blue-600">Inspection</span> Information</h1>

<form action="{{ route('admin.inspection.index') }}" method="GET">
    <div class="d-flex align-items-center gap-2 mb-4">
        <label for="month">Pilih Bulan</label>
        <input type="month" name="month" id="month" value="{{ request('month', now()->format('Y-m')) }}" class="form-control w-auto">
        <button class="btn btn-primary">Tampilkan</button>
    </div>

    <div class="space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow rounded-xl p-4">
                    <h6>Management - Open</h6>
                    <h3>{{  $managementOpen }}</h3>
                </div>
            <div class="bg-white shadow rounded-xl p-4">
                    <h6>Management - Closed</h6>
                    <h3>{{  $managementClose }}</h3>
                </div>
            
            <div class="bg-white shadow rounded-xl p-4">
                    <h6>Routine - Open</h6>
                    <h3>{{  $routineOpen }}</h3>
                </div>
        <div class="bg-white shadow rounded-xl p-4">
                    <h6>Routine - Closed</h6>
                    <h3>{{  $routineClose }}</h3>
    </div>
            </div>
<div>
 <h1 class="text-xl font-bold mb-4 mt-4">Management Inspection</h1>
    <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Type</th>
                <th>Corrective Action</th>
                <th>Date</th>
                <th>Close Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($management as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->site->name }}</td>
                <td>{{ $m->user->name }}</td>
                <td>{{ $m->type }}</td>
                <td>{{ $m->corrective_action }}</td>
                <td>{{ $m->date }}</td>
                <td>{{ $m->close_date }}</td>
                  <td>{{ $m->status }}</td>
                <td>{{ $m->notes }}</td>
              
                <td>
                    <a href="{{ route('admin.inspection.show', $m->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No data available</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div>
    <h1 class="text-xl font-bold mb-4 mt-8">Routine Inspection</h1>
    <table class="w-full border mb-6 text-sm" >
        <thead class="bg-gray-200">
        <tr>
            <th>No</th>
            <th>Sites</th>
            <th>User</th>
            <th>Type</th>
             <th>Corrective Action</th>
             <th>Date</th>
            <th>Close Date</th>
            <th>Status</th>
             <th>Notes</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($routine as $r )
             <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->site->name }}</td>
                <td>{{ $r->user->name }}</td>
                <td>{{ $r->type }}</td>
                <td>{{ $r->corrective_action }}</td>
                <td>{{ $r->date }}</td>
                   <td>{{ $r->close_date }}</td>
                <td>{{ $r->status }}</td>
                 <td>{{ $r->notes }}</td>
                <td>
                    <a href="{{ route('admin.inspection.show', $r->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @empty
             <tr><td colspan="4" class="text-center">No data available</td></tr>
             @endforelse
        </tbody>
    </table>
    </div>
</form>

@endsection