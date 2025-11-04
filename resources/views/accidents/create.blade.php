@extends('layouts.navbar-user')

@section('title', ' Add New Accident')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Accident</h2>

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
        <form action="{{ route('accidents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Category --}}
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium">Category</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded" required>
                    <!-- <option value="">-- pilih kategori --</option> -->
                    <option value="work accident" {{ old('category') == 'work accident' ? 'selected' : '' }}>Work Accident</option>
                    <option value="traffic accident" {{ old('category') == 'traffic accident' ? 'selected' : '' }}>Traffic Accident</option>
                    <option value="non-work accident" {{ old('category') == 'non-work accident' ? 'selected' : '' }}>Non Work Accident</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            {{-- Type --}}
            <div class="mb-4" id="type-container">
                <label for="type" class="block text-sm font-medium">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
                    <!-- <option value="">-- pilih type --</option> -->
                    <option value="Fatality" {{ old('type') == 'Fatality' ? 'selected' : '' }}>Fatality</option>
                    <option value="Major injury" {{ old('type') == 'Major injury' ? 'selected' : '' }}>Major Injury</option>
                    <option value="Minor injury" {{ old('type') == 'Minor injury' ? 'selected' : '' }}>Minor Injury</option>
                    <option value="Property damage" {{ old('type') == 'Property damage' ? 'selected' : '' }}>Property Damage</option>
                    <option value="Non Work Accident" {{ old('type') == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident</option>
                    <option value="Occupational disease" {{ old('type') == 'Occupational disease' ? 'selected' : '' }}>Occupational Disease</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <input id="description" type="text" name="description"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('description') }}" required>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium">Date Accident</label>
                <input id="date" type="date" name="date"
                    class="mt-1 block w-full border-gray-300 rounded"
                    value="{{ old('date', date('Y-m-d')) }}" required>
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            {{-- File --}}
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium">File</label>
                <input id="file" type="file" name="file" class="mt-1 block w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium">Status</label>
                <input type="hidden" name="status" value="open">
                <p class="mt-1 text-gray-700">Open</p>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('accidents.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category');
            const typeSelect = document.getElementById('type');
            const typeContainer = document.getElementById('type-container');

            const options = {
                'work accident': [
                    { value: 'Fatality', text: 'Fatality' },
                    { value: 'Major injury', text: 'Major Injury' },
                    { value: 'Minor injury', text: 'Minor Injury' }
                ],
                'non-work accident': [
                    { value: 'Property damage', text: 'Property Damage' },
                    { value: 'Non Work Accident', text: 'Non Work Accident' },
                    { value: 'Occupational disease', text: 'Occupational Disease' }
                ]
            };

            categorySelect.addEventListener('change', function () {
                const selected = this.value;
                typeSelect.innerHTML = '<option value="">-- pilih type --</option>';

                if (selected === 'traffic accident') {
                    typeContainer.style.display = 'none';
                    typeSelect.value = '';
                    return;
                }

                typeContainer.style.display = 'block';

                if (options[selected]) {
                    options[selected].forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt.value;
                        option.textContent = opt.text;
                        typeSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
@endsection
