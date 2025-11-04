@extends('layouts.navbar')

@section('content')

<form action="{{ route('admin.training.update', $training) }}" method="POST">
    @csrf
    @method('PUT')

       <div>
        <x-input-label for="name" :value="__('Name')" />
        <select id="select" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
            <option value="Training POP" {{ $training->name == 'Training POP' ? 'selected' : '' }}>Training POP</option>
            <option value="Training POM" {{ $training->name == 'Training POM' ? 'selected' : '' }}>Training POM</option>
            <option value="Training POU" {{ $training->name == 'Training POU' ? 'selected' : '' }}>Training POU</option>
            <option value="Others" {{ $training->name == 'Others' ? 'selected' : '' }}>Others</option>
        </select>

        <div id="others" style="display: none; margin-top: 10px;">
            <x-input-label for="other_name" :value="__('another training name')" />
            <x-text-input id="other_name" class="block mt-1 w-full" type="text" name="other_name" :value="old('other_name', $training->other_name)" />
            <x-input-error :messages="$errors->get('other_name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select name="type" class="mt-1 block w-full border-gray-300 rounded" required >
            <option value="mandatory" {{$training->type == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
            <option value="non-mandatory" {{$training->type == 'non-mandatory' ? 'selected' : '' }}>Non-mandatory</option>
        </select>
    </div>

    <div>
        <x-input-label for="provider" :value="__('Provider')" />
        <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider', $training->provider)" required />
        <x-input-error :messages="$errors->get('provider')" class="mt-2" />
    </div>

   <div class="flex items-center space-x-2 mt-4">
    <button type="submit" class="btn btn-primary">Update Training</button>
    <a href="{{ route('admin.training.index') }}" class="btn btn-danger">Cancel</a>
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

        toggleOthers(); 

        select.addEventListener('change', toggleOthers);
    });
</script>
@endsection