@extends('layouts.navbar-user')

@section('title', 'Tambah Accidents')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Accidents Baru</h1>

<form action="{{ route('accidents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    {{-- Type --}}
    <div>
        <x-input-label for="type" :value="__('Type')" class="text-black" />
        <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            <option value="Fatality" {{ old('type') == 'Fatality' ? 'selected' : '' }}>Fatality</option>
            <option value="Major injury" {{ old('type') == 'Major injury' ? 'selected' : '' }}>Major injury</option>
            <option value="Minor injury" {{ old('type') == 'Minor injury' ? 'selected' : '' }}>Minor injury</option>
            <option value="Traffic Accident" {{ old('type') == 'Traffic Accident' ? 'selected' : '' }}>Traffic Accident</option>
            <option value="Non Work Accident" {{ old('type') == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    {{-- Description --}}
    <div>
        <x-input-label for="description" :value="__('Description')" class="text-black" />
        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    {{-- Date --}}
    <div>
        <x-input-label for="date" :value="__('Date')" class="text-black" />
        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus autocomplete="date" />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
    </div>

    {{-- gambar --}}
    <div>
        <x-input-label for="image" :value="__('Image')" class="text-black" />
        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus autocomplete="image" />
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

{{-- Status --}}
<div>
    <x-input-label for="status" :value="__('Status')" class="text-black" />
    <input type="hidden" name="status" value="open">
    <p class="mt-1 text-gray-700">Open</p>
</div>



    {{-- Submit Button --}}
    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
        </button>
    </div>
</form>
@endsection
