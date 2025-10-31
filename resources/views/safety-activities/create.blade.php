@extends('layouts.navbar-user')

@section('title', 'Buat Safety Activity')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Buat Safety Activity</h2>

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
        <form action="{{ route('safety-activities.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- Type --}}
            <div class="mb-4">
                <label class="block text-sm font-medium">Type</label>
                <select id="type_select" name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- pilih --</option>
                    <option value="safety_talk" {{ old('type') == 'safety_talk' ? 'selected' : '' }}>Safety Talk</option>
                    <option value="p5m" {{ old('type') == 'p5m' ? 'selected' : '' }}>P5M</option>
                    <option value="meeting" {{ old('type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                    <option value="campaign" {{ old('type') == 'campaign' ? 'selected' : '' }}>Campaign</option>
                    <option value="others" {{ old('type') == 'others' ? 'selected' : '' }}>Others</option>
                </select>

                {{-- Input muncul kalau pilih "Others" --}}
                <div id="others_div" style="display: none; margin-top: 10px;">
                    <x-input-label for="other_type" :value="__('another activity name')" />
                    <x-text-input id="other_type" class="block mt-1 w-full" type="text" name="other_type"
                        :value="old('other_type')" />
                    <x-input-error :messages="$errors->get('other_type')" class="mt-2" />
                </div>
            </div>

            {{-- Frequency --}}
            <div class="mb-4">
                <label class="block text-sm font-medium">Frequency</label>
                <select name="frequency" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">-- pilih --</option>
                    <option value="daily" {{ old('frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ old('frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                    class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            {{-- Notes --}}
            <div class="mb-4">
                <label class="block text-sm font-medium">Notes</label>
                <textarea name="notes" class="mt-1 block w-full border-gray-300 rounded">{{ old('notes') }}</textarea>
            </div>

            {{-- File --}}
            <div class="mb-4">
                <label class="block text-sm font-medium">File</label>
                <input type="file" name="file" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            {{-- Tombol --}}
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                <a href="{{ route('safety-activities.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
        </form>
    </div>

    {{-- Script "Others" --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('type_select');
            const othersDiv = document.getElementById('others_div');
            const otherInput = document.getElementById('other_type');

            function toggleOthers() {
                if (select.value === 'others') {
                    othersDiv.style.display = 'block';
                    otherInput.disabled = false;
                } else {
                    othersDiv.style.display = 'none';
                    otherInput.disabled = true;
                    otherInput.value = '';
                }
            }

            toggleOthers(); // cek saat pertama kali
            select.addEventListener('change', toggleOthers);
        });
    </script>
@endsection
