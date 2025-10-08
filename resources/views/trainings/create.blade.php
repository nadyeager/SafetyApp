@extends('layouts.app')

@section('title', 'Buat Training')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Buat Training Baru</h2>

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
        <form action="{{ route('trainings.store') }}" method="POST">
            @csrf

            {{-- Jika admin, tampilkan dropdown site --}}
            @if(!empty($sites) && auth()->user()->role === 'admin')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Site</label>
                    <select name="site_id" class="mt-1 block w-full border-gray-300 rounded">
                        <option value="">-- pilih site --</option>
                        @foreach($sites as $id => $label)
                            <option value="{{ $id }}" {{ old('site_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                {{-- untuk user biasa kita kirim site via backend (tidak tampilkan) --}}
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- pilih --</option>
                    <option value="mandatory" {{ old('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
                    <option value="non-mandatory" {{ old('type') == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Provider</label>
                <input type="text" name="provider" value="{{ old('provider') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Expired Date</label>
                <input type="date" name="expired_date" value="{{ old('expired_date') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                <a href="{{ route('trainings.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
