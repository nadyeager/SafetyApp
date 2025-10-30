@extends('layouts.navbar-user')

@section('title', 'Edit Safety Activity')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Safety Activity</h2>

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
    <form action="{{ route('safety-activities.update', $safetyActivity) }}" method="POST">
        @csrf
        @method('PUT')

        @if(!empty($sites) && auth()->user()->role === 'admin')
            <div class="mb-4">
                <label class="block text-sm font-medium">Site</label>
                <select name="site_id" class="mt-1 block w-full border-gray-300 rounded" required>
                    @foreach($sites as $id => $label)
                        <option value="{{ $id }}" {{ old('site_id', $safetyActivity->site_id) == $id ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">User</label>
                <select name="user_id" class="mt-1 block w-full border-gray-300 rounded" required>
                    @foreach($users as $id => $label)
                        <option value="{{ $id }}" {{ old('user_id', $safetyActivity->user_id) == $id ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium">Type</label>
            <input type="text" name="type" value="{{ old('type', $safetyActivity->type) }}" class="mt-1 block w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Frequency</label>
            <input type="text" name="frequency" value="{{ old('frequency', $safetyActivity->frequency) }}" class="mt-1 block w-full border-gray-300 rounded" required>   

        <div class="mb-4">
            <label class="block text-sm font-medium">Date</label>
            <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($safetyActivity->date)->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Notes</label>
            <textarea name="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded">{{ old('notes', $safetyActivity->notes) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">File</label>
            <input type="file" name="file" class="mt-1 block w-full border-gray-300 rounded">
        </div>  

        <div class="flex items-center space-x-2">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            <a href="{{ route('safety-activities.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
