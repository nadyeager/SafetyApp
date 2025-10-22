@extends('layouts.navbar-user')

@section('content')

<form action="{{ route('accidents.update', $accident->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Category --}}
    <div>
        <x-input-label for="category" :value="__('Category')" class="text-black" />
        <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            <option value="work accident" {{ old('category', $accident->category) == 'work accident' ? 'selected' : '' }}>Work Accident</option>
            <option value="traffic accident" {{ old('category', $accident->category) == 'traffic accident' ? 'selected' : '' }}>Traffic Accident</option>
            <option value="non-work accident" {{ old('category', $accident->category) == 'non-work accident' ? 'selected' : '' }}>Non Work Accident</option>
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    {{-- Type --}}
    <div>
        <x-input-label for="type" :value="__('Type')" class="text-black" />
        <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">-- pilih --</option>
            <option value="Fatality" {{ old('type', $accident->type) == 'Fatality' ? 'selected' : '' }}>Fatality</option>
            <option value="Major injury" {{ old('type', $accident->type) == 'Major injury' ? 'selected' : '' }}>Major injury</option>
            <option value="Minor injury" {{ old('type', $accident->type) == 'Minor injury' ? 'selected' : '' }}>Minor injury</option>
           <option value="Property damage" {{ old('type', $accident->type) == 'Property damage' ? 'selected' : '' }}>Property damage</option>
           <option value="Non Work Accident" {{ old('type', $accident->type) == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident</option>
           <option value="Occupational disease" {{ old('type', $accident->type) == 'Occupational disease' ? 'selected' : '' }}>Occupational disease</option>
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

    {{-- gambar --}}
    <div>
        <x-input-label for="image" :value="__('Image')" />
      @if ($accident->image)
      <img src="{{ asset('storage/' . $accident->image) }}" alt="{{ $accident->image }}" width="100" class="mb-2">
    @endif
    <x-text-input id="image" name="image" type="file" class="block mt-1 w-full" />
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
   </div>

    {{-- Status --}}
    <div>
        <x-input-label for="status" :value="__('Status')" />
       <input type="hidden" name="status" value="open">
       <p class="mt-1 text-gray-700">Open</p>
    </div>

    {{-- Submit --}}
    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </div>
</form>

@endsection