@extends('layouts.navbar-admin')

@section('content')

<form action="{{ route('admin.inspection.update', $inspection) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" id="type" class="form-select mt-1 block w-full">
            <option value="management" {{ $inspection->type == 'management' ? 'selected' : '' }}>Management</option>
            <option value="routine" {{ $inspection->type == 'routine' ? 'selected' : '' }}>Routine</option>
        </select>
    </div>

    <div>
        <x-input-label for="corrective_action" :value="__('Corrective Action')" />
        <input type="text" name="corrective_action" id="corrective_action" 
               class="form-input mt-1 block w-full" 
               value="{{ old('corrective_action', $inspection->corrective_action) }}" />
    </div>

    <div>
        <x-input-label for="date" :value="__('Inspection Date')" />
        <input type="date" name="date" id="date" 
               class="form-input mt-1 block w-full" 
               value="{{ old('date', $inspection->date->format('Y-m-d')) }}" />
    </div>

    <div>
        <x-input-label for="notes" :value="__('Notes')" />
        <textarea name="notes" id="notes" 
                  class="form-textarea mt-1 block w-full" 
                  rows="4">{{ old('notes', $inspection->notes) }}</textarea>
    </div>

    <div class="flex items-center space-x-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        <a href="{{ route('admin.inspection.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
    </div>
    </div>
    </div>
</form>
@endsection