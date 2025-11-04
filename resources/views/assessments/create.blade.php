@extends('layouts.navbar-user')

@section('title', ' Add New Assessment')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Assessment</h2>

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
        <form action="{{ route('assessments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (!empty($sites) && auth()->user()->role === 'admin')
                <div class="mb-4">
                    <label class="block text-sm font-medium">Site</label>
                    <select name="site_id" class="mt-1 block w-full border-gray-300 rounded">
                        <option value="">-- pilih site --</option>
                        @foreach ($sites as $id => $label)
                            <option value="{{ $id }}" {{ old('site_id') == $id ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium">Type</label>
                <!-- ✅ Tambahkan id="select" -->
                <select id="select" name="type" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="SMK3" {{ old('type') == 'SMK3' ? 'selected' : '' }}>SMK3</option>
                    <option value="SMKP" {{ old('type') == 'SMKP' ? 'selected' : '' }}>SMKP</option>
                    <option value="AGC" {{ old('type') == 'AGC' ? 'selected' : '' }}>AGC</option>
                    <option value="MKA" {{ old('type') == 'MKA' ? 'selected' : '' }}>MKA</option>
                    <option value="CSMS" {{ old('type') == 'CSMS' ? 'selected' : '' }}>CSMS</option>
                    <option value="Others" {{ old('type') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                <!-- Input muncul kalau pilih "Others" -->
                <div id="others" style="display: none; margin-top: 10px;">
                    <x-input-label for="other_name" :value="__('another assessment name')" />
                    <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name"
                        :value="old('other_name')" />
                    <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Score</label>
                <input type="number" name="score" step="0.01" min="0" max="100"
                    value="{{ old('score') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                    class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">File</label>
                <input type="file" name="file" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('assessments.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
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

            toggleOthers(); // Jalankan saat halaman pertama kali dimuat
            select.addEventListener('change', toggleOthers);
        });
    </script>
@endsection
