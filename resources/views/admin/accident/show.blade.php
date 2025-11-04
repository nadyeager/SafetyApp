@extends('layouts.navbar')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-center mb-8">Detail Accident</h2>

    <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6 
                flex flex-col md:flex-row-reverse md:items-center gap-8">

        <div class="flex-shrink-0 flex justify-center md:justify-end">
           @php
    $isImage = Str::endsWith($accident->file, ['.jpg', '.jpeg', '.png', '.gif']);
@endphp

@if ($isImage)
    <img src="{{ asset('storage/' . $accident->file) }}" 
         alt="{{ $accident->file }}" 
         class="w-64 h-64 object-cover rounded-xl border border-gray-300 shadow-sm">
@else
    <a href="{{ asset('storage/' . $accident->file) }}" target="_blank" 
       class="text-blue-600 underline">Lihat File</a>
@endif

        </div>

    
        <div class="flex-1 space-y-3 text-gray-800">
            <p><span class="font-semibold text-gray-700">Sites:</span> {{ $accident->site->name }}</p>
            <p><span class="font-semibold text-gray-700">Nama:</span> {{ $accident->user->name }}</p>
            <p><span class="font-semibold text-gray-700">Category:</span> {{ $accident->category }}</p>
            <p><span class="font-semibold text-gray-700">Tipe:</span> {{ ucfirst($accident->type) }}</p>
            <p><span class="font-semibold text-gray-700">Deskripsi:</span> {{ $accident->description }}</p>
            <p><span class="font-semibold text-gray-700">Tanggal:</span> {{ $accident->date->format('d-m-Y') }}</p>

            <p>
                <span class="font-semibold text-gray-700">Status Accident:</span>
                <span class="px-3 py-1 rounded-full 
                    {{ $accident->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($accident->status) }}
                </span>
            </p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.accident.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-xl transition">
            Kembali
        </a>
    </div>
</div>
@endsection
