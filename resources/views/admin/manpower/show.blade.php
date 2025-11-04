@extends('layouts.navbar')

@section('content')

 <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-8">Detail Man Power</h1>

        <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6
        flex flex-col md:flex-row-reverse md:items-center gap-8">

        <div class="flex-1 space-y-3 text-gray-800">
            <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $manpower->site->name }}</p>
            <p><strong class="font-semibold text-gray-700">Type:</strong> {{ $manpower->type }}</p>
            <p><strong class="font-semibold text-gray-700">Gender:</strong>{{ $manpower->gender }}</p>
            <p><strong class="font-semibold text-gray-700">Total:</strong>{{ $manpower->total }}</p>
            <p><strong class="font-semibold text-gray-700">Month:</strong>{{ $manpower->month }}</p>
            <p><strong class="font-semibold text-gray-700">Year:</strong>{{ $manpower->year }}</p>

        </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.manpower.index') }}" class="btn btn-secondary mb-4">Back</a>
        </div>

@endsection