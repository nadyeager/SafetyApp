@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="max-w-2xl mx-auto mt-10">
        <h2 class="text-2xl font-bold text-center mb-8">Update Certification</h2>

        <form action="{{ route('admin.certification.update', $certification->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
        <x-input-label for="name" :value="__('Name')" />
        <select id="select" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
            <option value="Certification AK3U" {{ $certification->name == 'Certification AK3U' ? 'selected' : '' }}>Certification AK3U</option>
            <option value="Certification AK3 Listrik" {{ $certification->name == 'Certification AK3 Listrik' ? 'selected' : '' }}>Certification AK3 Listrik</option>
            <option value="Certification First Aid" {{ $certification->name == 'Certification First Aid' ? 'selected' : '' }}>Certification First Aid</option>
            <option value="Certification Accident Investigation" {{ $certification->name == 'Certification Accident Investigation' ? 'selected' : '' }}>Certification Accident Investigation</option>
            <option value="Others" {{ $certification->name == 'Others' ? 'selected' : '' }}>Others</option>
        </select>
            </div>

        <div id="others" style="display: none; margin-top: 10px;">
            <x-input-label for="other_name" :value="__('another certification name')" />
            <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name" :value="old('other_name', $certification->other_name)" />
            <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
    </div>


    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" class="mt-1 block w-full border-gray-300 rounded" required >
            <option value="mandatory" {{ $certification->type == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
            <option value="non-mandatory" {{ $certification->type == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
        </select>
    </div>

            <div class="mb-4">
                <x-input-label for="provider" :value="__('Provider')" />
                <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider', $certification->provider)" required />
                <x-input-error :messages="$errors->get('provider')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="expired_date" :value="__('Expired Date')" />
                <x-text-input id="expired_date" class="block mt-1 w-full" type="date" name="expired_date" :value="old('expired_date', $certification->expired_date)" required />
                <x-input-error :messages="$errors->get('expired_date')" class="mt-2" />
            </div>

           <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-800 text-white rounded mt-4">Update</button>
            <a href="{{ route('admin.certification.index') }}" class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white rounded mt-4">Back</a>
           </div>
</div>
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