{{-- @extends('layouts.navbar-admin')

@section('content')
<h1 class="text-2xl text=bold">Update Investigation</h1>

<form action="{{ route('investigations.update', $investigation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Investigator</label>
        <input type="text" name="investigator" value="{{ old('investigator', $investigation->investigator) }}">
    </div>

    <div>
        <label>Root Cause</label>
        <input type="text" name="root_cause" value="{{ old('root_cause', $investigation->root_cause) }}">
    </div>

    <div>
        <label>Corrective Action</label>
        <input type="text" name="corrective_action" value="{{ old('corrective_action', $investigation->corrective_action) }}">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">Update</button>
</form>


@endsection --}}