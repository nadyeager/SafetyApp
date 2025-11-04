@extends('layouts.navbar')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6 mt-8">

    <h1 class="text-2xl font-bold mb-6 text-center">Edit Safety Activity</h1>

    <form action="{{ route('admin.safetyActivity.update', $safetyActivity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Type --}}
        <div class="mb-4">
            <x-input-label for="type_select" :value="__('Type')" />
            <select id="type_select" name="type" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                <option value="">-- pilih --</option>
                <option value="safety_talk" {{ $safetyActivity->type == 'safety_talk' ? 'selected' : '' }}>Safety Talk</option>
                <option value="p5m" {{ $safetyActivity->type == 'p5m' ? 'selected' : '' }}>P5M</option>
                <option value="meeting" {{ $safetyActivity->type == 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="campaign" {{ $safetyActivity->type == 'campaign' ? 'selected' : '' }}>Campaign</option>
                <option value="Others" {{ $safetyActivity->type == 'Others' ? 'selected' : '' }}>Others</option>
            </select>

            {{-- Input muncul kalau pilih "Others" --}}
            <div id="others_div" class="mt-3" style="display: none;">
                <x-input-label for="other_type" :value="__('Another Activity Name')" />
                <x-text-input 
                    id="other_type"
                    class="block mt-1 w-full"
                    type="text"
                    name="other_type"
                    :value="old('other_type', $safetyActivity->other_type)"
                />
                <x-input-error :messages="$errors->get('other_type')" class="mt-2" />
            </div>
        </div>

        {{-- Frequency --}}
        <div class="mb-4">
            <x-input-label for="frequency" :value="__('Frequency')" />
            <select name="frequency" id="frequency" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                <option value="">-- pilih --</option>
                <option value="daily" {{ $safetyActivity->frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $safetyActivity->frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $safetyActivity->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <x-input-label for="date" :value="__('Date')" />
            <x-text-input 
                id="date"
                type="date"
                name="date"
                value="{{ old('date', optional($safetyActivity->date)->format('Y-m-d')) }}"
                class="mt-1 block w-full border-gray-300 rounded-lg"
                required
            />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        {{-- Notes --}}
        <div class="mb-4">
            <x-input-label for="notes" :value="__('Notes')" />
            <textarea 
                name="notes"
                id="notes"
                rows="3"
                class="mt-1 block w-full border-gray-300 rounded-lg"
            >{{ old('notes', $safetyActivity->notes) }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>

        {{-- File --}}
        <div class="mb-6">
            <x-input-label for="file" :value="__('File')" />
            @if ($safetyActivity->file)
                @php
                    $isImage = Str::endsWith(Str::lower($safetyActivity->file), ['.jpg', '.jpeg', '.png', '.gif']);
                @endphp

                <div class="my-2">
                    @if ($isImage)
                        <img src="{{ asset('storage/' . $safetyActivity->file) }}" alt="{{ $safetyActivity->file }}" class="h-24 rounded border border-gray-300 shadow-sm">
                    @else
                        <a href="{{ asset('storage/' . $safetyActivity->file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
                    @endif
                </div>
            @endif

            <x-text-input 
                id="file"
                type="file"
                name="file"
                class="block mt-1 w-full"
                autocomplete="file"
            />
            <x-input-error :messages="$errors->get('file')" class="mt-2" />
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">
            <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Update
            </button>
            <a href="{{ route('admin.safetyActivity.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow">
                Back
            </a>
        </div>

    </form>
</div>

{{-- Script: menampilkan input "Others" jika dipilih --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('type_select');
    const othersDiv = document.getElementById('others_div');
    const otherInput = document.getElementById('other_type');

    function toggleOthers() {
        if (select.value === 'Others') {
            othersDiv.style.display = 'block';
            otherInput.disabled = false;
            otherInput.focus();
        } else {
            othersDiv.style.display = 'none';
            otherInput.disabled = true;
        }
    }

    toggleOthers(); // Jalankan saat pertama kali halaman dimuat
    select.addEventListener('change', toggleOthers);
});
</script>

@endsection
