@extends('layouts.app')

@section('title', 'Buat Safety Activity')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Buat Safety Activity</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('safety-activities.store') }}" method="POST">
            @csrf

            @if(!empty($sites) && auth()->user()->role === 'admin')
                <div class="mb-4">
                    <label class="block text-sm font-medium">Site</label>
                    <select name="site_id" class="mt-1 block w-full border-gray-300 rounded">
                        <option value="">-- pilih site --</option>
                        @foreach($sites as $id => $label)
                            <option value="{{ $id }}" {{ old('site_id') == $id ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium">Type</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- pilih --</option>
                    <option value="safety_talk" {{ old('type') == 'safety_talk' ? 'selected' : '' }}>Safety Talk</option>
                    <option value="p5m" {{ old('type') == 'p5m' ? 'selected' : '' }}>P5M</option>
                    <option value="meeting" {{ old('type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                    <option value="campaign" {{ old('type') == 'campaign' ? 'selected' : '' }}>Campaign</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" 
                       class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Notes</label>
                <textarea name="notes" class="mt-1 block w-full border-gray-300 rounded">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                <a href="{{ route('safety-activities.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
