@extends('layouts.app')

@section('tittle', 'Edit Manpower')

@section('content')

 <form action="{{ route('manpowers.update', $manpower) }}" method="POST">
    @method('PUT')
        @csrf
        <div>
            <x-input-label for="type" :value="__('Type')" />
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">-- pilih --</option>
                    <option value="organik" {{ old('type', $manpower->type ) == 'organik' ? 'selected' : '' }}>organik</option>
                    <option value="partner" {{ old('type', $manpower->type ) == 'partner' ? 'selected' : '' }}>partner</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

      <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded">
                <option value="male" {{ old('gender', $manpower->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $manpower->gender) == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
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
                       <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>

    @endsection




