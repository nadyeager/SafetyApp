@extends('layouts.app')

@section('title', 'Edit Assessment')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Edit Assessment</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('assessments.update', $assessment) }}" method="POST">
            @csrf
            @method('PUT')

            @if(!empty($sites) && auth()->user()->role === 'admin')
                <div class="mb-4">
                    <label class="block text-sm font-medium">Site</label>
                    <select name="site_id" class="mt-1 block w-full border-gray-300 rounded" required>
                        @foreach($sites as $id => $label)
                            <option value="{{ $id }}" {{ old('site_id', $assessment->site_id) == $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium">Type</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="SMK3" {{ old('type', $assessment->type) == 'SMK3' ? 'selected' : '' }}>SMK3</option>
                    <option value="SMKP" {{ old('type', $assessment->type) == 'SMKP' ? 'selected' : '' }}>SMKP</option>
                    <option value="AGC" {{ old('type', $assessment->type) == 'AGC' ? 'selected' : '' }}>AGC</option>
                    <option value="MKA" {{ old('type', $assessment->type) == 'MKA' ? 'selected' : '' }}>MKA</option>
                    <option value="CSMS" {{ old('type', $assessment->type) == 'CSMS' ? 'selected' : '' }}>CSMS</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Score</label>
                <input type="number" name="score" step="0.01" min="0" max="100" value="{{ old('score', $assessment->score) }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($assessment->date)->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('assessments.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
