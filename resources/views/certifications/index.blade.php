@extends('layouts.navbar-user')

@section('content')

<h1 class="mb-4 mt-4">Halaman Certifications</h1>
    <a href="{{ route('certifications.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        + Buat Certification
    </a>
    <table class="min-w-full bg-gray-400 border border-gray-200 mt-4">
       <thead class="bg-gray-500">
         <tr>
            <th class="px-3 py-4 text-left text-semibold">No</th>
            <th class="px-3 py-4 text-left text-semibold">Name</th>
            <th class="px-3 py-4 text-left text-semibold">Site</th>
            <th class="px-3 py-4 text-left text-semibold">Certification Name</th>
            <th class="px-3 py-4 text-left text-semibold">Type</th>
            <th class="px-3 py-4 text-left text-semibold">Provider</th>
            <th class="px-3 py-4 text-left text-semibold">Expired Date</th>
        </tr>
       </thead>
       <tbody>
        @foreach ($certification as $c )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->user->name }}</td>
            <td>{{ $c->site->name }}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->type }}</td>
            <td>{{ $c->provider }}</td>
            <td>{{ $c->expired_date }}</td>
        </tr>
         @endforeach
       </tbody>
    </table>
</div>
@endsection