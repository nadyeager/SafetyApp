@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold mb-4"><span class="text-blue-600">Inspection</span> Information</h1>

<form method="GET">
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
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Type</th>
                <th>Notes</th>
                <th>Corecctive Action</th>
                <th>Date</th>
                <th>Status</th>
                <th>Close Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inspection as $i)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $i->site->name }}</td>
                <td>{{ $i->user->name }}</td>
                <td>{{ $i->type }}</td>
                <td>{{ $i->notes }}</td>
                <td>{{ $i->corrective_action }}</td>
                <td>{{ $i->date }}</td>
                <td>{{ $i->status }}</td>
                <td>{{ $i->close_date }}</td>
                <td>
                    <a href="{{ route('admin.inspection.show', $i->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
</form>

@endsection