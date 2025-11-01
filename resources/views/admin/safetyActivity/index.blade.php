@extends('layouts.navbar')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    <span class="text-purple-600">Safety Mandatory Activity</span> Information
</h1>

<div class="bg-white shadow-md rounded-xl border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="border px-4 py-3">No</th>
                    <th class="border px-4 py-3">Jenis Kegiatan</th>
                    <th class="border px-4 py-3">Frequency</th>
                    <th class="border px-4 py-3">Date</th>
                    <th class="border px-4 py-3">Notes</th>
                    <th class="border px-4 py-3">File</th>
                    <th class="border px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($safetyActivity as $s)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-2 text-gray-600">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2 font-medium text-gray-800">{{ $s->type }}</td>
                        <td class="border px-4 py-2 text-gray-700">{{ ucfirst($s->frequency) }}</td>
                        <td class="border px-4 py-2">{{ $s->date->format('d-m-Y') }}</td>
                        <td class="border px-4 py-2 text-gray-600">
                            {{ $s->notes ?: '-' }}
                        </td>
                        <td class="border px-4 py-2 text-blue-600">
                            @if ($s->file)
                                <a href="{{ asset('storage/' . $s->file) }}" target="_blank" 
                                   class="text-blue-500 hover:underline font-medium">
                                    View File
                                </a>
                            @else
                                <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.safetyActivity.edit', $s->id) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                               Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500 italic">
                            No data available
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
