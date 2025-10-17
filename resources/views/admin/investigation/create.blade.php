@extends('layouts.navbar-admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Investigation</h1>

@if($accident->investigation->isEmpty())
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
@else
    <p class="text-red-500">This accident has already been investigated</p>

    <div class="container mt-4">
        <h1>Existing Investigation</h1>
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th>No</th>
                    <th>Accident</th>
                    <th>Investigator</th>
                    <th>Root Cause</th>
                    <th>Corrective Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accident->investigation as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->accident->type }}</td>
                        <td>{{ $i->investigator ?? '-' }}</td>
                        <td>{{ $i->root_cause ?? '-' }}</td>
                        <td>{{ $i->corrective_action ?? '-' }}</td>
                        <td>
                            <a href="{{ route('investigations.edit', $i->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Update</a>
                            <form action="{{ route('investigations.destroy', $i->id) }}" method="POST" onsubmit="return confirm('Are you sure deleted this?')" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
