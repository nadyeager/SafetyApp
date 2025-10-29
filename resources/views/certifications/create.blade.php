@extends('layouts.navbar-user')

@section('content')

<h1 class="mb-4">Halaman buat certification</h1>

@if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('certifications.store') }}" method="POST">
    @csrf
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <select id="select" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
            <option value="Certification AK3U" {{ old('name') == 'Certification AK3U' ? 'selected' : '' }}>Certification AK3U</option>
            <option value="Certification AK3 Listrik" {{ old('name') == 'Certification AK3 Listrik' ? 'selected' : '' }}>Certification AK3 Listrik</option>
            <option value="Certification First Aid" {{ old('name') == 'Certification First Aid' ? 'selected' : '' }}>Certification First Aid</option>
            <option value="Certification Accident Investigation" {{ old('name') == 'Certification Accident Investigation' ? 'selected' : '' }}>Certification Accident Investigation</option>
            <option value="Others" {{ old('name') == 'Others' ? 'selected' : '' }}>Others</option>
        </select>

        <div id="others" style="display: none; margin-top: 10px;">
            <x-input-label for="other_name" :value="__('another certification name')" />
            <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name" :value="old('other_name')" />
            <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
    </div>
    </div>

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" class="mt-1 block w-full border-gray-300 rounded" required >
            <option value="mandatory" {{ old('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
            <option value="non-mandatory" {{ old('type') == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
        </select>
    </div>

    <div>
        <x-input-label for="provider" :value="__('Provider')" />
        <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider')" required />
        <x-input-error :messages="$errors->get('provider')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="expired_date" :value="__('Expired Date')" />
        <x-text-input id="expired_date" class="block mt-1 w-full" type="date" name="expired_date" :value="old('expired_date')" required />
        <x-input-error :messages="$errors->get('expired_date')" class="mt-2" />
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded mt-4">Simpan</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('select');
    const othersInputDiv = document.getElementById('others');
    const othersInput = document.getElementById('other_name');


function toggleOthers() {
    if (select.value === 'Others') {
        othersInputDiv.style.display = 'block';
        othersInput.disabled = false;
    } else {
        othersInputDiv.style.display = 'none';
        othersInput.disabled = true;
        othersInput.value = '';
    }
    }

    toggleOthers();
    
    select.addEventListener('change', toggleOthers);
});
    
</script>

@endsection