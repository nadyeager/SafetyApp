@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold text-green-600 mb-4">EHS Training Development  <span class="text-gray-900">Information</span></h1>

<form method="GET" action="{{ route('admin.training.index') }}" class="mb-4 gap-2">
    <select name="type" class="form-select w-auto">
        <option value="">Semua Type</option>
        <option value="mandatory" {{ request('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
        <option value="non-mandatory" {{ request('type') == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('admin.training.index') }}" class="btn btn-secondary">Reset</a>
</form>


<div class="p-6">

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 text-blue-800 p-4 rounded-xl text-center">
            <h3 class="font-semibold text-sm">Total Mandatory</h3>
            <p class="text-2xl font-bold">{{ $summary['total_mandatory'] }}</p>
        </div>

        <div class="bg-green-100 text-green-800 p-4 rounded-xl text-center">
            <h3 class="font-semibold text-sm">Total Non-Mandatory</h3>
            <p class="text-2xl font-bold">{{ $summary['total_non_mandatory'] }}</p>
        </div>

        <div class="bg-red-100 text-red-800 p-4 rounded-xl text-center">
            <h3 class="font-semibold text-sm">Expired</h3>
            <p class="text-2xl font-bold">{{ $summary['expired'] }}</p>
        </div>
    </div>

    @if (!$type || $type === 'mandatory')
    <h2 class="text-xl font-bold  mb-3">Mandatory Training / Certification</h2>

    @foreach ($mandatory as $trainingName => $records)
    <h3 class="text-lg font-semibold mt-4">{{ $trainingName }}</h3>
    <table class="w-full border mb-4 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Nama Peserta</th>
                <th class="border px-3 py-2">Site</th>
                <th class="border px-3 py-2">Expired Date</th>
                <th class="border px-3 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $training)
            @php 
            $isExpired = $training->expired_date && $training->expired_date < now();
            @endphp
            <tr>
                <td class="border px-3 py-2">{{ $training->user->name }}</td>
                <td class="border px-3 py-2">{{ $training->site->name }}</td>
                <td class="border px-3 py-2">{{ $training->expired_date }}</td>
                <td class="border px-3 py-2 text-center">
                    @if ($isExpired)
                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">Expired</span>
                    @else
                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Active</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    @endif

    @if(!$type || $type === 'non-mandatory')
    <h2 class="text-xl font-bold mb-3 mt-8">Non-Mandatory Training / Certification</h2>

    @foreach( $non_mandatory as $trainingName => $records)
    <h3 class="text-lg font-semibold mt-4">{{ $trainingName }}</h3>

    <table class="w-full border mb-4 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Nama Peserta</th>
                <th class="border px-3 py-2">Site</th>
                <th class="border px-3 py-2">Expired Date</th>
                <th class="border px-3 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $training) 
            @php
            $isExpired = $training->expired_date && $training->expired_date < now();
            @endphp
            <tr>
                <td class="border px-3 py-2">{{ $training->user->name }}</td>
                <td class="border px-3 py-2">{{ $training->site->name }}</td>
                <td class="border px-3 py-2">{{ $training->expired_date ?? '-' }}</td>
                <td class="border px-3 py-2 text-center">
                    @if ($isExpired)
                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">Expired</span>
                    @else
                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Active</span>
                    @endif
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    @endforeach
    @endif
</div>


@endsection