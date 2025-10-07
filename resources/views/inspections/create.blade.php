@extends('layouts.app')

@section('title', 'Buat Inspeksi')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Buat Inspeksi Baru</h2>

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
        <form action="{{ route('inspections.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">-- pilih --</option>
                    <option value="management" {{ old('type') == 'management' ? 'selected' : '' }}>Management</option>
                    <option value="routine" {{ old('type') == 'routine' ? 'selected' : '' }}>Routine</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded">{{ old('notes') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="close" {{ old('status') == 'close' ? 'selected' : '' }}>Close</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                <a href="{{ route('inspections.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
