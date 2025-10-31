@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-semibold">Man Power</h1>

<table class="min-w-full bg-white border border-gray-200 mt-4">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">No</th>
            <th class="py-2 px-4 border-b">Sites</th>
            <th class="py-2 px-4 border-b">Type</th>
            <th class="py-2 px-4 border-b">Gender</th>
            <th class="py-2 px-4 border-b">Total</th>
            <th class="py-2 px-4 border-b">Month</th>
            <th class="py-2 px-4 border-b">Year</th>
            <th class="py-2 px-4 border-b">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($manpower as $person)
        <tr>
            <td class="py-2 px-4 border-b">{{ $person->id }}</td>
            <td class="py-2 px-4 border-b">{{ $person->site->name }}</td>
            <td class="py-2 px-4 border-b">{{ $person->type}}</td>
            <td class="py-2 px-4 border-b">{{ $person->gender }}</td>
            <td class="py-2 px-4 border-b">{{ $person->total }}</td>
            <td class="py-2 px-4 border-b">{{ $person->month }}</td>
            <td class="py-2 px-4 border-b">{{ $person->year }}</td>
            <td class="py-2 px-4 border-b">
                <a href="{{ route('admin.manpower.edit', $person->id) }}" class="text-blue-500 hover:underline">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection