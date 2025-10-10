@extends('layouts.app')

@section('title', 'Edit Manhours')

@section('content')

<form action="{{ route('manhours.update', $manhour) }}" method="POST">
    @csrf
      @method('PUT')
           <div>
            <x-input-label for="type" :value="__('Type')" />
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">-- pilih --</option>
                    <option value="organik" {{ old('type', $manhour->type) == 'organik' ? 'selected' : '' }}>organik</option>
                    <option value="partner" {{ old('type', $manhour->type) == 'partner' ? 'selected' : '' }}>partner</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="total_hours" :value="__('Total_Hours')" />
                <x-text-input id="total_hours" class="block mt-1 w-full" type="number" name="total_hours" :value="old('total_hours', $manhour->total_hours)" required autofocus autocomplete="off" />
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
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
               Update
            </button>
        </div>
    </form>
    @endsection