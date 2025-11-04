@extends('layouts.navbar')

@section('content')

<form action="{{ route('admin.user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

<div> 
    <x-input-label for="site_id" :value="__('Sites')" />
    <select id="site_id" name="site_id" class="block mt-1 w-full border-gray-300 rounded">
        <option value="">-- Pilih Site --</option>
        @foreach ($sites as $site)
            <option value="{{ $site->id }}" 
                {{ old('site_id', $user->site_id ?? '') == $site->id ? 'selected' : '' }}>
                {{ $site->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('site_id')" class="mt-2" />
</div>

<div>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Update</button>
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Back</a>
</div>

</form>

@endsection