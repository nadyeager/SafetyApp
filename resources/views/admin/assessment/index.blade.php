@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold text-pink-600 mb-4">
Safety Audit & Assessment <span class="text-gray-900">Information </span></h1>

<form method="GET" action="{{ route('admin.assessment.index') }}" class="mb-4 gap-2">
    <select name="type" class="form-select w-auto mb-6">
        <option value="">Semua Type</option>
        <option value="SMK3" {{ request('type') == 'SMK3' ? 'selected' : '' }}>SMK3</option>
        <option value="SMKP" {{ request('type') == 'SMKP' ? 'selected' : '' }}>SMKP</option>
        <option value="AGC" {{ request('type') == 'AGC' ? 'selected' : '' }}>AGC</option>
        <option value="MKA" {{ request('type') == 'MKA' ? 'selected' : '' }}>MKA</option>
        <option value="CSMS" {{ request('type') == 'CSMS' ? 'selected' : '' }}>CSMS</option>
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('admin.assessment.index') }}" class="btn btn-secondary">Reset</a>

    <table class="w w-full border mb-4 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Type</th>
                <th>Score</th>
                <th>Site</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assessments as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->date }}</td>
                <td>{{ $a->type }}</td>
                <td>{{ $a->score }}</td>
                <td>{{ $a->site->name }}</td>
                <td>{{ $a->user->name }}</td>
                <td>
                    {{-- <a href="{{ route('admin.assessment.show', $a->id) }}" class="btn btn-sm btn-info">View</a> --}}
                </td>
            </tr>  
            @endforeach
        </tbody>
</form> 
  

@endsection