@extends('layouts.navbar-admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Investigations List</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="table-auto w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th>No</th>
            <th>Accident</th>
            <th>Investigator</th>
            <th>Root Cause</th>
            <th>Corrective Action</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($investigation as $i)
            <tr class="border-b">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $i->accident->type ?? '-' }}</td>
                <td class="p-2">{{ $i->investigator ?? '-' }}</td>
                <td class="p-2">{{ $i->root_cause ?? '-' }}</td>
                <td class="p-2">{{ $i->corrective_action ?? '-' }}</td>
                <td class="p-2 flex space-x-2">
                    <a href="{{ route('investigations.edit', $i->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Update</a>
                    <form action="{{ route('investigations.destroy', $i->id) }}" method="POST" onsubmit="return confirm('Are you sure deleted this?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
