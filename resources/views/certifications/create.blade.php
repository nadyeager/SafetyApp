@extends('layouts.navbar-user')

@section('title', ' Add New Certification')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Certification</h2>

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
        <form action="{{ route('certifications.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="select" class="block text-sm font-medium">Name</label>
                <select id="select" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- certification --</option>
                    <option value="Certification AK3U" {{ old('name') == 'Certification AK3U' ? 'selected' : '' }}>Certification AK3U</option>
                    <option value="Certification AK3 Listrik" {{ old('name') == 'Certification AK3 Listrik' ? 'selected' : '' }}>Certification AK3 Listrik</option>
                    <option value="Certification First Aid" {{ old('name') == 'Certification First Aid' ? 'selected' : '' }}>Certification First Aid</option>
                    <option value="Certification Accident Investigation" {{ old('name') == 'Certification Accident Investigation' ? 'selected' : '' }}>Certification Accident Investigation</option>
                    <option value="Others" {{ old('name') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                <div id="others" style="display: none; margin-top: 10px;">
                    <x-input-label for="other_name" :value="__('Another Certification Name')" />
                    <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name"
                        :value="old('other_name')" />
                    <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
                </div>
            </div>

            {{-- Type --}}
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="mandatory" {{ old('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
                    <option value="non-mandatory" {{ old('type') == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            {{-- Provider --}}
            <div class="mb-4">
                <label for="provider" class="block text-sm font-medium">Provider</label>
                <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider"
                    :value="old('provider')" required />
                <x-input-error :messages="$errors->get('provider')" class="mt-2" />
            </div>

            {{-- Expired Date --}}
            <div class="mb-4">
                <label for="expired_date" class="block text-sm font-medium">Expired Date</label>
                <x-text-input id="expired_date" class="block mt-1 w-full" type="date" name="expired_date"
                    :value="old('expired_date')" required />
                <x-input-error :messages="$errors->get('expired_date')" class="mt-2" />
            </div>

            {{-- Buttons --}}
            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('certifications.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
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
                    othersDiv.style.display = 'block';
                    otherInput.disabled = false;
                } else {
                    othersDiv.style.display = 'none';
                    otherInput.disabled = true;
                    otherInput.value = '';
                }
            }

            toggleOthers();
            select.addEventListener('change', toggleOthers);
        });
    </script>
@endsection
