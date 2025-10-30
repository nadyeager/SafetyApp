@extends('layouts.navbar-user')

@section('title', 'Tambah Accidents')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Accidents Baru</h1>

    <form action="{{ route('admin.accidents.edit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
@method('PUT')
        <input type="hidden" name="id" value="{{ $accident->id }}">
        {{-- Category --}}
        <div>
            <x-input-label for="category" :value="__('Category')" class="text-black" />
            <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded">
                <option value="">-- pilih --</option>
                <option value="work accident" {{ old('category', $accident) == 'work accident' ? 'selected' : '' }}>Work Accident
                </option>
                <option value="traffic accident" {{ old('category', $accident) == 'traffic accident' ? 'selected' : '' }}>Traffic
                    Accident</option>
                <option value="non-work accident" {{ old('category', $accident) == 'non-work accident' ? 'selected' : '' }}>Non Work
                    Accident</option>
            </select>
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        {{-- Type --}}
        <div>
            <x-input-label for="type" :value="__('Type')" class="text-black" />
            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded">
                <option value="">-- pilih --</option>
                <option value="Fatality" {{ old('type', $accident) == 'Fatality' ? 'selected' : '' }}>Fatality</option>
                <option value="Major injury" {{ old('type', $accident) == 'Major injury' ? 'selected' : '' }}>Major injury</option>
                <option value="Minor injury" {{ old('type', $accident) == 'Minor injury' ? 'selected' : '' }}>Minor injury</option>
                <option value="Property damage" {{ old('type', $accident) == 'Property damage' ? 'selected' : '' }}>Property damage
                </option>
                <option value="Non Work Accident" {{ old('type', $accident) == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident
                </option>
                <option value="Occupational disease" {{ old('type', $accident) == 'Occupational disease' ? 'selected' : '' }}>
                    Occupational disease</option>
            </select>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        {{-- Description --}}
        <div>
            <x-input-label for="description" :value="__('Description')" class="text-black" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                :value="old('description', $accident)" required autofocus autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        {{-- Date --}}
        <div>
            <x-input-label for="date" :value="__('Date')" class="text-black" />
            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', $accident)" required
                autofocus autocomplete="date" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        {{-- gambar --}}
        <div>
            <x-input-label for="file" :value="__('File')" class="text-black" />
            <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" :value="old('file', $accident)" required
                autofocus autocomplete="file" />
            <x-input-error :messages="$errors->get('file')" class="mt-2" />
        </div>

        {{-- Status --}}
        <div>
            <x-input-label for="status" :value="__('Status', $accident)" class="text-black" />
            <input type="hidden" name="status" value="open">
            <p class="mt-1 text-gray-700">Open</p>
        </div>

        Tanggal Updated At: {{ $accident->updated_at }}



        {{-- Submit Button --}}
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Accidents
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const typeContainer = typeSelect.closest('div'); // ambil container div-nya
            const categorySelect = document.getElementById('category');

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
                const selectedCategory = this.value;
                typeSelect.innerHTML = '<option value="">-- pilih --</option>'; // reset dulu

                // Kalau traffic accident, sembunyikan dropdown type
                if (selectedCategory === 'traffic accident') {
                    typeContainer.style.display = 'none';
                    typeSelect.value = '';
                    return;
                }

                // Kalau work / non-work, tampilkan kembali dropdown type
                typeContainer.style.display = 'block';

                if (options[selectedCategory]) {
                    options[selectedCategory].forEach(opt => {
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