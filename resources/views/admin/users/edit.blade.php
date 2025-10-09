@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Edit Site User</h2>

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.user.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Nama user readonly -->
    <div class="mb-4">
        <label class="block font-medium">Nama User:</label>
        <input type="text" value="{{ $user->name }}" class="border rounded w-full px-3 py-2 bg-gray-100" readonly>
    </div>

    <!-- Pilih site -->
    <div class="mb-4">
        <label class="block font-medium">Pilih Site:</label>
      <select name="site_id" class="border rounded w-full px-3 py-2">
    @foreach($sites as $site)
        <option value="{{ $site->id }}" {{ $user->site_id == $site->id ? 'selected' : '' }}>
            {{ $site->name }}
        </option>
    @endforeach
</select>


    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
