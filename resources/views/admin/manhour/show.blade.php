@extends('layouts.navbar')

@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-8">Detail Man Hours</h1>

    <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6 
    flex flex-col md:flex-row-reverse md:items-center gap-8">

    <div class="flex-1 space-y-3 text-gray-800">
        <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $manhour->site->name }}</p>
        <p><strong class="font-semibold text-gray-700">Nama:</strong> {{ $manhour->type}}</p>
        <p><strong class="font-semibold text-gray-700">Total Hours:</strong>{{ $manhour->total_hours }}</p>
        <p><strong class="font-semibold text-gray-700">Month:</strong>{{ $manhour->month }}</p>
        <p><strong class="font-semibold text-gray-700">Year:</strong>{{ $manhour->year }}</p>

    </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.manhour.index') }}" class="btn btn-secondary mb-4">Back</a>
    </div>

@endsection