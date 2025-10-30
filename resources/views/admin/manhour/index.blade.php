@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-semibold">Man Hours</h1>

<table class="min-w-full bg-white border border-gray-200 mt-4">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">No</th>
            <th class="py-2 px-4 border-b">Sites</th>
            <th class="py-2 px-4 border-b">Type</th>
            <th class="py-2 px-4 border-b">Total Hours</th>
            <th class="py-2 px-4 border-b">Month</th>
            <th class="py-2 px-4 border-b">Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($manhour as $m )
        <tr>
            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
            <td class="py-2 px-4 border-b">{{ $m->site->name }}</td>
            <td class="py-2 px-4 border-b">{{ $m->type }}</td>
            <td class="py-2 px-4 border-b">{{ $m->total_hours }}</td>
            <td class="py-2 px-4 border-b">{{ $m->month }}</td>
            <td class="py-2 px-4 border-b">{{ $m->year }}</td>
        </tr>
          @endforeach
    </tbody>
</table>
@endsection