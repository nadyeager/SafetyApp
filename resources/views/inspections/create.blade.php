@extends('layouts.navbar-user')

@section('title', ' Add New Inspection')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Inspection</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('inspections.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded">
                    <!-- <option value="">-- pilih --</option> -->
                    <option value="management" {{ old('type') == 'management' ? 'selected' : '' }}>Management</option>
                    <option value="routine" {{ old('type') == 'routine' ? 'selected' : '' }}>Routine</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Corrective Action</label>
                <textarea name="corrective_action" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded">{{ old('corrective_action') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">File</label>
                <input type="file" name="file" class="mt-1 block w-full border-gray-300 rounded" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                    class="mt-1 block w-full border-gray-300 rounded" />
            </div>
<!-- 
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <input type="hidden" name="status" value="open">
                <p class="mt-1 text-gray-700">Open</p>
            </div> -->

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('inspections.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection