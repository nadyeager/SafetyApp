@extends('layouts.navbar')

@section('content')
 <div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-center mb-8">Detail Safety Activity</h2>

    <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6 
                flex flex-col md:flex-row-reverse md:items-center gap-8">

        <div class="flex-shrink-0 flex justify-center md:justify-end">
           @php
    $isImage = Str::endsWith($safetyActivity->file, ['.jpg', '.jpeg', '.png', '.gif']);
@endphp

@if ($isImage)
    <img src="{{ asset('storage/' . $safetyActivity->file) }}" 
         alt="{{ $safetyActivity->file }}" 
         class="w-64 h-64 object-cover rounded-xl border border-gray-300 shadow-sm">
@else
    <a href="{{ asset('storage/' . $safetyActivity->file) }}" target="_blank" 
       class="text-blue-600 underline">Lihat File</a>
@endif
        </div>

        <div class="flex-1 space-y-3 text-gray-800">
            <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $safetyActivity->site->name }}</p>
            <p><strong class="font-semibold text-gray-700">Nama:</strong> {{ $safetyActivity->user->name }}</p>
            <p><strong class="font-semibold text-gray-700">Type:</strong>{{ $safetyActivity->type }}</p>
            <p><strong class="font-semibold text-gray-700">Frequency:</strong>{{ $safetyActivity->frequency }}</p>
            <p><strong class="font-semibold text-gray-700">Date:</strong>{{ $safetyActivity->date->format('d-m-Y') }}</p>
            <p><strong class="font-semibold text-gray-700">Notes:</strong>{{ $safetyActivity->notes }}</p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.safetyActivity.index') }}" class="btn btn-secondary mb-4">Kembali</a>
    </div>
@endsection