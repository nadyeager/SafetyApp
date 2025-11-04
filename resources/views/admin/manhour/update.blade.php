@extends('layouts.navbar')

@section('content')

<form action="{{ route('admin.manhour.update', $manhour->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" id="type" class="form-select mt-1 block w-full">
            <option value="organik" {{ $manhour->type == 'organik' ? 'selected' : '' }}>Organik</option>
            <option value="partner" {{ $manhour->type == 'partner' ? 'selected' : '' }}>Partner</option>
        </select>
    </div>

    <div>
        <x-input-label for="total_hours" :value="__('Total_Hours')" />
        <x-text-input id="total_hours" class="block mt-1 w-full" type="number" name="total_hours" :value="old('total_hours', $manhour->total_hours)" required autofocus autocomplete="off"/>
        <x-input-error :messages="$errors->get('total_hours')" class="mt-2" />  
    </div>

    <div>
        <x-input-label for="month" :value="__('Month')" />
        <x-text-input id="month" type="number" name="month" min="1" max="12" :value="old('month', $manhour->month)" required />
        <x-input-error :messages="$errors->get('month')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="year" :value="__('Year')" />
        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year', $manhour->year)" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('year')" class="mt-2" />
    </div>

    <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update Manhours
        </button>
        <a href="{{ route('admin.manhour.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Back</a>
    </div>
</form>

@endsection