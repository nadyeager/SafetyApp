@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold text-yellow-600 mb-4">EHS Certification Development<span class="text-gray-900"> Information</span></h1>

  <form method="GET" action="{{ route('admin.certification.filter') }}" class="mb-4 d-flex gap-2">
        <select name="type" class="form-select w-auto">
            <option value="">Semua Type</option>
            <option value="mandatory" {{ request('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
            <option value="non-mandatory" {{ request('type') == 'non-mandatory' ? 'selected' : '' }}>Non Mandatory</option>
        </select>

        <button type="submit" class="btn btn-primary">filter</button>
        <a href="{{ route('admin.certification.filter') }}" class="btn btn-secondary">reset</a>
  </form>

<form method="GET" action="{{ route('admin.certification.index') }}" class="mb-4 gap-2">
     <div class="space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow rounded-xl p-4">
                    <h6>Mandatory</h6>
                    <h3>{{  $total_mandatory }}</h3>
                </div>
 
                 <div class="bg-white shadow rounded-xl p-4">
                    <h6>Non Mandatory</h6>
                    <h3>{{  $total_non_mandatory }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-4">
                    <h6>Expiring Soon</h6>
                    <h3>{{  $expiring_soon }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-4">
                    <h6>Expired</h6>
                    <h3>{{  $expired }}</h3>
            </div>
        </div>

            <h1>Mandatory Certification</h1>
            <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Certification Name</th>
                <th>Type</th>
                <th>Provider</th>
                <th>Expired Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($mandatory as $c )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->site->name }}</td>
            <td>{{ $c->user->name }}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->type }}</td>
            <td>{{ $c->provider }}</td>
            <td>{{ $c->expired_date }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <h1></h1>Non Mandatory Certification</h1>
            <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Certification Name</th>
                <th>Type</th>
                <th>Provider</th>
                <th>Expired Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($non_mandatory as $c )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->site->name }}</td>
            <td>{{ $c->user->name }}</td>
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