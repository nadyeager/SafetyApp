@extends('layouts.navbar')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-purple-600">Man Power <span class="text-gray-800 font-semibold">Information</span></h1>
</div>

<div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b">No</th>
                    <th class="px-4 py-3 border-b">Sites</th>
                    <th class="px-4 py-3 border-b">Type</th>
                    <th class="px-4 py-3 border-b">Gender</th>
                    <th class="px-4 py-3 border-b">Total</th>
                    <th class="px-4 py-3 border-b">Month</th>
                    <th class="px-4 py-3 border-b">Year</th>
                    <th class="px-4 py-3 border-b text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($manpower as $person)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2 text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 font-medium text-gray-800">{{ $person->site->name }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ ucfirst($person->type) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $person->gender == 'male' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ $person->gender }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-gray-800 font-semibold">{{ number_format($person->total) }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $person->month }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $person->year }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('admin.manpower.edit', $person->id) }}"
                                 class="text-blue-600 hover:text-blue-800 font-medium">
                                Edit
                            </a>
                            <a href="{{ route('admin.manpower.show', $person->id) }}"
                                 class="text-pink-600 hover:text-pink-800 font-medium">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500 italic">No manpower data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
