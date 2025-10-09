@extends('layouts.app')

@section('title', 'Buat Accident Investigation')

@section('content')
<div class="container">

    {{-- Pesan sukses / error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!$investigation)
        <h1>Buat Accident Investigation</h1>

        <form action="{{ route('investigations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="accident_id" value="{{ $accident->id }}">

            <div>
                <x-input-label for="investigator" :value="__('Investigator')" />
                <x-text-input id="investigator" name="investigator" type="text"
                    class="mt-1 block w-full" :value="old('investigator')" required autofocus />
                <x-input-error :messages="$errors->get('investigator')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="root_cause" :value="__('Root Cause')" />
                <x-text-input id="root_cause" name="root_cause" type="text"
                    class="mt-1 block w-full" :value="old('root_cause')" required />
                <x-input-error :messages="$errors->get('root_cause')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="corrective_action" :value="__('Corrective Action')" />
                <x-text-input id="corrective_action" name="corrective_action" type="text"
                    class="mt-1 block w-full" :value="old('corrective_action')" required />
                <x-input-error :messages="$errors->get('corrective_action')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="close" {{ old('status') == 'close' ? 'selected' : '' }}>Close</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    @else
        <h5>Investigasi sudah dibuat</h5>
        <p><strong>Investigator:</strong> {{ $investigation->investigator }}</p>
        <p><strong>Status:</strong> {{ ucfirst($investigation->status) }}</p>
    @endif
</div>
@endsection
