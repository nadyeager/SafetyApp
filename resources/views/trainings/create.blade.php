@extends('layouts.navbar-user')

@section('title', ' Add New Training')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Training</h2>

    {{-- Error Handling --}}
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('trainings.store') }}" method="POST">
            @csrf

            {{-- Nama Training --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nama Training</label>
                <select id="select" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
                    <!-- <option value="">-- pilih training --</option> -->
                    <option value="Training POP" {{ old('name') == 'Training POP' ? 'selected' : '' }}>Training POP</option>
                    <option value="Training POM" {{ old('name') == 'Training POM' ? 'selected' : '' }}>Training POM</option>
                    <option value="Training POU" {{ old('name') == 'Training POU' ? 'selected' : '' }}>Training POU</option>
                    <option value="Others" {{ old('name') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Nama Training Lainnya --}}
            <div id="others" class="mb-4 hidden">
                <label for="other_name" class="block text-sm font-medium">Nama Training Lainnya</label>
                <input id="other_name" type="text" name="other_name"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('other_name') }}">
                <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
            </div>

            {{-- Tipe --}}
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium">Tipe Training</label>
                <select name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <!-- <option value="">-- pilih tipe --</option> -->
                    <option value="mandatory" {{ old('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
                    <option value="non-mandatory" {{ old('type') == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            {{-- Provider --}}
            <div class="mb-4">
                <label for="provider" class="block text-sm font-medium">Provider</label>
                <input id="provider" type="text" name="provider"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('provider') }}" required>
                <x-input-error :messages="$errors->get('provider')" class="mt-2" />
            </div>

            {{-- Tombol --}}
            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('trainings.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('select');
            const othersDiv = document.getElementById('others');
            const otherInput = document.getElementById('other_name');

            function toggleOthers() {
                if (select.value === 'Others') {
                    othersDiv.classList.remove('hidden');
                    otherInput.disabled = false;
                } else {
                    othersDiv.classList.add('hidden');
                    otherInput.disabled = true;
                    otherInput.value = '';
                }
            }

            toggleOthers();
            select.addEventListener('change', toggleOthers);
        });
    </script>
@endsection
