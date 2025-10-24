@extends('layouts.navbar-admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Investigation</h1>

    <form action="{{ route('investigations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="accident_id" value="{{ $accident->id }}">

        <div class="mb-3">
            <x-input-label for="investigator" :value="__('Investigator')" />
            <x-text-input id="investigator" name="investigator" :value="old('investigator')" required />
            <x-input-error :messages="$errors->get('investigator')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="root_cause" :value="__('Root Cause')" />
            <x-text-input id="root_cause" name="root_cause" :value="old('root_cause')" required />
            <x-input-error :messages="$errors->get('root_cause')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="corrective_action" :value="__('Corrective Action')" />
            <x-text-input id="corrective_action" name="corrective_action" :value="old('corrective_action')" required />
            <x-input-error :messages="$errors->get('corrective_action')" class="mt-2" />
        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>
@endsection