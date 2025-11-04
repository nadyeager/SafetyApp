@extends('layouts.navbar')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Assessment</h1>

<form action="{{ route('admin.assessment.update', $assessment) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
                <label class="block text-sm font-medium">Type</label>
                <select id="select" name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="SMK3" {{ $assessment->type == 'SMK3' ? 'selected' : '' }}>SMK3</option>
                    <option value="SMKP" {{ $assessment->type == 'SMKP' ? 'selected' : '' }}>SMKP</option>
                    <option value="AGC" {{ $assessment->type == 'AGC' ? 'selected' : '' }}>AGC</option>
                    <option value="MKA" {{ $assessment->type == 'MKA' ? 'selected' : '' }}>MKA</option>
                    <option value="CSMS" {{ $assessment->type == 'CSMS' ? 'selected' : '' }}>CSMS</option>
                    <option value="Others" {{ $assessment->type == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                <div id="others" style="display: none; margin-top: 10px;">
                    <x-input-label for="other_name" :value="__('another assessment name')" />
                    <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name"
                        :value="old('other_name', $assessment->other_name)" />
                    <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Score</label>
                <input type="number" name="score" step="0.01" min="0" max="100"
                    value="{{ old('score', $assessment->score) }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date', $assessment->date->format('d-m-Y')) }}"
                    class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

             <div class="mb-4">
        <x-input-label for="file" :value="__('File')" />
        @if ($assessment->file)
            @php
                $isImage = Str::endsWith($assessment->file, ['.jpg', '.jpeg', '.png', '.gif']);
            @endphp
            @if ($isImage)
                <img src="{{ asset('storage/' . $assessment->file) }}" alt="{{ $assessment->file }}" class="h-20 mb-2">
            @else
                <a href="{{ asset('storage/' . $assessment->file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
            @endif
        @endif
        <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" autofocus autocomplete="file" />
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
    </div>

            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                <a href="{{ route('admin.assessment.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
            </div>
            
        </form>


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

            toggleOthers(); // Jalankan saat halaman pertama kali dimuat
            select.addEventListener('change', toggleOthers);
        });
    </script>


@endsection