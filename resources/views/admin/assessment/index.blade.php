@extends('layouts.navbar')

@section('content')

<h1 class="text-2xl font-bold text-pink-600 mb-4">
    Safety Audit & Assessment <span class="text-gray-900">Information</span>
</h1>


<form method="GET" action="{{ route('admin.assessment.index') }}" class="mb-6 flex flex-wrap items-center gap-3">

    <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-500 focus:outline-none">
        <option value="">Semua Type</option>
        <option value="SMK3" {{ request('type') == 'SMK3' ? 'selected' : '' }}>SMK3</option>
        <option value="SMKP" {{ request('type') == 'SMKP' ? 'selected' : '' }}>SMKP</option>
        <option value="AGC" {{ request('type') == 'AGC' ? 'selected' : '' }}>AGC</option>
        <option value="MKA" {{ request('type') == 'MKA' ? 'selected' : '' }}>MKA</option>
        <option value="CSMS" {{ request('type') == 'CSMS' ? 'selected' : '' }}>CSMS</option>
    </select>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
        Filter
    </button>

    <a href="{{ route('admin.assessment.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
        Reset
    </a>
</form>


<div class="overflow-x-auto bg-white shadow-sm border border-gray-200 rounded-xl">
    <table class="w-full text-sm text-left border-collapse">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 border">No</th>
                <th class="px-4 py-3 border">Date</th>
                <th class="px-4 py-3 border">Type</th>
                <th class="px-4 py-3 border">Score</th>
                <th class="px-4 py-3 border">Site</th>
                <th class="px-4 py-3 border">User</th>
                <th class="px-4 py-3 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assessments as $a)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $a->date }}</td>
                    <td class="border px-4 py-2 font-medium text-gray-800">{{ $a->type }}</td>
                    <td class="border px-4 py-2 text-pink-700 font-semibold">{{ $a->score }}</td>
                    <td class="border px-4 py-2">{{ $a->site->name }}</td>
                    <td class="border px-4 py-2">{{ $a->user->name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.assessment.edit', $a->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                           Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
