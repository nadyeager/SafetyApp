@extends('layouts.navbar')

@section('content')

<form action="{{ route('admin.inspection.update', $inspection) }}" method="POST" enctype="multipart/form-data">
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
               value="{{ old('date',$inspection->date->format('Y-m-d')) }}" />
    </div>  

    <div>
        <x-input-label for="file" :value="__('File')" />
        @if ($inspection->file)
            @php
                $isImage = Str::endsWith($inspection->file, ['.jpg', '.jpeg', '.png', '.gif']);
            @endphp
            @if ($isImage)
                <img src="{{ asset('storage/' . $inspection->file) }}" alt="{{ $inspection->file }}" class="h-20 mb-2">
            @else
                <a href="{{ asset('storage/' . $inspection->file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
            @endif
        @endif
        <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" autofocus autocomplete="file" />
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
    </div>

    <div class="flex items-center space-x-2 mt-4">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        <a href="{{ route('admin.inspection.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
    </div>
</form>

@endsection
