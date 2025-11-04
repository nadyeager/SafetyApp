@extends('layouts.navbar')

@section('content')

<form action="{{ route('admin.manpower.update', $manpower->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" id="type" class="form-select mt-1 block w-full">
            <option value="organik" {{ $manpower->type == 'organik' ? 'selected' : '' }}>Organik</option>
            <option value="partner" {{ $manpower->type == 'partner' ? 'selected' : '' }}>Partner</option>
        </select>
    </div>

    <div>
        <x-input-label for="gender" :value="__('Gender')" />
        <select name="gender" id="gender" class="form-select mt-1 block w-full">
            <option value="male" {{ $manpower->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $manpower->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <div>
        <x-input-label for="total" :value="__('Total')" />
        <x-text-input id="total" class="block mt-1 w-full" type="text" name="total" :value="old('total', $manpower->total)" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('total')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="month" :value="__('Month')" />
        <x-text-input id="month" type="number" name="month" min="1" max="12" :value="old('month', $manpower->month)" required />
        <x-input-error :messages="$errors->get('month')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="year" :value="__('Year')" />
        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year', $manpower->year)" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('year')" class="mt-2" />
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Update</button>
        <a href="{{ route('admin.manhour.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Back</a>
    </div>

@endsection