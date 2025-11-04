@extends('layouts.navbar-user')

@section('title', 'Edit Accident')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Edit Accident Data</h2>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('accidents.update', $accident->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Category --}}
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium">Category</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- select category --</option>
                    <option value="work accident" {{ old('category', $accident->category) == 'work accident' ? 'selected' : '' }}>Work Accident</option>
                    <option value="traffic accident" {{ old('category', $accident->category) == 'traffic accident' ? 'selected' : '' }}>Traffic Accident</option>
                    <option value="non-work accident" {{ old('category', $accident->category) == 'non-work accident' ? 'selected' : '' }}>Non Work Accident</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            {{-- Type --}}
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- select type --</option>
                    <option value="Fatality" {{ old('type', $accident->type) == 'Fatality' ? 'selected' : '' }}>Fatality</option>
                    <option value="Major injury" {{ old('type', $accident->type) == 'Major injury' ? 'selected' : '' }}>Major Injury</option>
                    <option value="Minor injury" {{ old('type', $accident->type) == 'Minor injury' ? 'selected' : '' }}>Minor Injury</option>
                    <option value="Property damage" {{ old('type', $accident->type) == 'Property damage' ? 'selected' : '' }}>Property Damage</option>
                    <option value="Non Work Accident" {{ old('type', $accident->type) == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident</option>
                    <option value="Occupational disease" {{ old('type', $accident->type) == 'Occupational disease' ? 'selected' : '' }}>Occupational Disease</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <input id="description" name="description" type="text"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('description', $accident->description) }}" required>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium">Accident Date</label>
                <input id="date" name="date" type="date"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('date', $accident->date) }}" required>
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            {{-- File --}}
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium">Attachment / File</label>
                @if ($accident->file)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $accident->file) }}" alt="{{ $accident->file }}"
                            class="w-32 h-32 object-cover rounded border mb-2">
                        <p class="text-sm text-gray-500">Current file: {{ basename($accident->file) }}</p>
                    </div>
                @endif
                <input id="file" name="file" type="file" class="mt-1 block w-full border-gray-300 rounded">
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium">Status</label>
                <input type="hidden" name="status" value="open">
                <p class="mt-1 text-gray-700">Open</p>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Save Changes
                </button>
                <a href="{{ route('accidents.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
