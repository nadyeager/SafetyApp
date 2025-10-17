@extends('layouts.navbar-admin')

@section('content')
<div class="container">
    <h1>Detail Inspection</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Sites:</strong> {{ $inspection->site->name }}</p>
            <p><strong>Nama:</strong> {{ $inspection->user->name }}</p>
            <p><strong>Type:</strong>{{ $inspection->type }}</p>
            <p><strong>Notes:</strong>{{ $inspection->notes }}</p>
            <p><strong>Corecctive Action:</strong>{{ $inspection->corrective_action }}</p>
            <p><strong>Date:</strong>{{ $inspection->date }}</p>
            <p><strong>Status:</strong>{{ $inspection->status }}</p>
            <p><strong>Close Date:</strong>{{ $inspection->close_date }}</p>
        </div>
</div>

<form method="POST" action="{{ route('admin.inspection.update', $inspection->id) }}">
    @csrf
    @method('PUT')
<h1 class="text-xl">Update Inspection</h1>

<div>
    <x-input-label for="type" :value="__('Type')" />
    <x-text-input id="type" name="type" :value="old('type', $inspection->type)" required />
    <x-input-error :messages="$errors->get('type')" class="mt-2" />
</div>

<div>
    <x-input-label for="notes" :value="__('Notes')" />
    <x-text-input id="notes" name="notes" :value="old('notes', $inspection->notes)" required />
    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
</div>

<div>
    <x-input-label for="corrective_action" :value="__('Corrective Action')" />
    <x-text-input id="corrective_action" name="corrective_action" :value="old('corrective_action', $inspection->corrective_action)" required />
    <x-input-error :messages="$errors->get('corrective_action')" class="mt-2" />
</div>
<div>
    <x-input-label for="date" :value="__('Date')" />
    <x-text-input id="date" name="date" type="date" :value="old('date', $inspection->date)" required />
    <x-input-error :messages="$errors->get('date')" class="mt-2" />
</div>
<div>
    <x-input-label for="status" :value="__('Status')" />
   <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded">
    <option value="">-- pilih --</option>
    <option value="open" {{ old('status', $inspection->status) == 'open' ? 'selected' : '' }}>Open</option>
    <option value="close" {{ old('status', $inspection->status) == 'close' ? 'selected' : '' }}>Close</option>
   </select>
</div>
<div>
    <x-input-label for="close_date" :value="__('Close Date')" />
    <x-text-input id="close_date" name="close_date" type="date" :value="old('close_date', $inspection->close_date)" required />
    <x-input-error :messages="$errors->get('close_date')" class="mt-2" />
</div>

<div>
    <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
        Simpan Update
    </button>
</div>
</form>

@endsection