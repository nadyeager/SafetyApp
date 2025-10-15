@extends('layouts.navbar-admin')

@section('content')
<h1 class ="text-2xl font-bold mb-4">Investigations</h1>

<form action="{{ route('investigations.store') }}" method="POST">
    <div class="mb-4">
      <div>
        <x-input-label for="investigator" :value="__('Investigator')" />
        <x-text-input id="investigator" class="block mt-1 w-full" type="text" name="investigator" :value="old('investigator')" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('investigator')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="root_cause" :value="__('Root Cause')" />
        <x-text-input id="root_cause" class="block mt-1 w-full" type="text" name="root_cause" :value="old('root_cause')" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('root_cause')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="corrective_action" :value="__('Corrective Action')" />
        <x-text-input id="corrective_action" class="block mt-1 w-full" type="text" name="corrective_action" :value="old('corrective_action')" required autofocus autocomplete="off" />
        <x-input-error :messages="$errors->get('corrective_action')" class="mt-2" />
      </div

      <div>
        <button type="submit" class="block w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Submit</button>
      </div>



@endsection