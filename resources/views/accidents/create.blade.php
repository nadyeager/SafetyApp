@extends('layouts.app')

@section('title', 'Tambah Accidents')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Accidents Baru</h1>

<form action="{{ route('accidents.store') }}" method="POST" class="space-y-4">
    @csrf

    {{-- Site_ID --}}
    {{-- <div>
        <x-input-label for="site_id" :value="__('Site')" class="text-black" />
        <select name="site_id" id="site_id" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            @foreach($sites as $s)
                <option value="{{ $s->id }}" {{ old('site_id') == $s->id ? 'selected' : '' }}>
                    {{ $s->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('site_id')" class="mt-2" />
    </div> --}}

    {{-- Type --}}
    <div>
        <x-input-label for="type" :value="__('Type')" class="text-black" />
        <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            <option value="fatal" {{ old('type') == 'fatal' ? 'selected' : '' }}>Fatal</option>
            <option value="major" {{ old('type') == 'major' ? 'selected' : '' }}>Major</option>
            <option value="minor" {{ old('type') == 'minor' ? 'selected' : '' }}>Minor</option>
            <option value="traffic" {{ old('type') == 'traffic' ? 'selected' : '' }}>Traffic</option>
            <option value="non-work" {{ old('type') == 'non-work' ? 'selected' : '' }}>Non Work</option>
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

    {{-- Status --}}
    <div>
        <x-input-label for="status" :value="__('Status')" class="text-black" />
        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded">
            <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="close" {{ old('status') == 'close' ? 'selected' : '' }}>Close</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    {{-- Submit Button --}}
    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
        </button>
    </div>
</form>
@endsection
