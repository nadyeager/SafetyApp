@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold mb-6"><span class="text-purple-600">Safety Mandatory Activity</span> Information</h1>

<table class="table-auto w-full border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border px-4 py-2 text-left">No</th>
            <th class="border px-4 py-2 text-left">Jenis Kegiatan</th>
            <th class="border px-4 py-2 text-left">Jumlah Pelaksanaan</th>
            <th class="border px-4 py-2 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($safetyActivity as $index => $row )
        <tr>
            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border px-4 py-2">{{ $labels[$row->type] ?? $row->type }}</td>
            <td class="border px-4 py-2">{{ $row->total }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.safetyActivity.edit', $row->type) }}" class="text-blue-500 hover:underline">Edit</a>
            </td>
        </tr>
            
        @endforeach
    
    </tbody>
</table>

@endsection