@extends('layouts.navbar-user')

@section('content')

<h1 class="mb-4">Halaman training</h1>
<a href="{{ route('trainings.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
    + Buat Training
</a>

<div>
   <table class="min-w-full bg-gray-400 border border-gray-200 mt-4">
       <thead class="bg-gray-500">
            <tr>
                <th class="px-3 py-4 text-left text-semibold">No</th>
                <th class="px-3 py-4 text-left text-semibold">Name</th>
                <th class="px-3 py-4 text-left text-semibold">Site</th>
                <th class="px-3 py-4 text-left text-semibold">Training Name</th>
                <th class="px-3 py-4 text-left text-semibold">Type</th>
                <th  class="px-3 py-4 text-left text-semibold">Provider</th>
            </tr>
        </thead>
        <tbody>
            @foreach($training as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->user->name }}</td>
                <td>{{ $t->site->name }}</td>
                <td>{{ $t->name }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ $t->provider }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection