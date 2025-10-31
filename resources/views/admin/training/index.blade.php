@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold text-green-600 mb-4">EHS Training Development <span class="text-gray-900">Information</span></h1>



  <form method="GET" action="{{ route('admin.training.filter') }}" class="mb-4 d-flex gap-2">
        <select name="type" class="form-select w-auto">
            <option value="">Semua Type</option>
            <option value="mandatory" {{ request('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
            <option value="non-mandatory" {{ request('type') == 'non-mandatory' ? 'selected' : '' }}>Non Mandatory</option>
        </select>

        <button type="submit" class="btn btn-primary">filter</button>
        <a href="{{ route('admin.training.filter') }}" class="btn btn-secondary">reset</a>
  </form>

    <form method="GET" action="{{ route('admin.training.index') }}" class="mb-4 gap-2">
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
            </div>

            <h1>Mandatory Training</h1>
            <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Training Name</th>
                <th>Type</th>
                <th>Provider</th>
                <th>Action</th>
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
            <td>
               <a href="{{ route('admin.training.edit', $c->id) }}" class="text-blue-500 hover:underline">Edit</a>
        </tr>
        @endforeach
        </tbody>
            </table>

            <h1>Non Mandatory Training</h1>
            <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Sites</th>
                <th>User</th>
                <th>Training Name</th>
                <th>Type</th>
                <th>Provider</th>
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
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</form>
@endsection
  