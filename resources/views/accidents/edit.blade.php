@extends('layouts.app')

@section('content')

<form action="{{ route('accidents.update', $accident->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Type --}}
    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            <option value="fatal" {{ old('type', $accident->type) == 'fatal' ? 'selected' : '' }}>Fatal</option>
            <option value="major" {{ old('type', $accident->type) == 'major' ? 'selected' : '' }}>Major</option>
            <option value="minor" {{ old('type', $accident->type) == 'minor' ? 'selected' : '' }}>Minor</option>
            <option value="traffic" {{ old('type', $accident->type) == 'traffic' ? 'selected' : '' }}>Traffic</option>
            <option value="non-work" {{ old('type', $accident->type) == 'non-work' ? 'selected' : '' }}>Non Work</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    {{-- Description --}}
    <div>
        <x-input-label for="description" :value="__('Description')" />
        <x-text-input id="description" name="description" type="text"
            class="block mt-1 w-full"
            :value="old('description', $accident->description)" required autofocus />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    {{-- Date --}}
    <div>
        <x-input-label for="date" :value="__('Date')" />
        <x-text-input id="date" name="date" type="date"
            class="block mt-1 w-full"
            :value="old('date', $accident->date)" required />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
    </div>

    {{-- Status --}}
    <div>
        <x-input-label for="status" :value="__('Status')" />
        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded">
            <option value="open" {{ old('status', $accident->status) == 'open' ? 'selected' : '' }}>Open</option>
            <option value="close" {{ old('status', $accident->status) == 'close' ? 'selected' : '' }}>Close</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    {{-- Submit --}}
    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </div>
</form>

@endsection