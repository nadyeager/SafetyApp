@extends('layouts.navbar-admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Investigation Details</h1>

<div class="bg-white shadow-md rounded p-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Investigator:</h2>
        <p>{{ $investigation->investigator }}</p>
    </div>
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Root Cause:</h2>
        <p>{{ $investigation->root_cause }}</p>
    </div>
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Corrective Action:</h2>
        <p>{{ $investigation->corrective_action }}</p>
    </div>
</div>
@endsection
