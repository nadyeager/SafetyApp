@extends('layouts.navbar')

@section('content')
<div class="container">
    <div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-center mb-8">Detail Inspection</h2>

    <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6 
                flex flex-col md:flex-row-reverse md:items-center gap-8">

        <div class="flex-shrink-0 flex justify-center md:justify-end">
           @php
    $isImage = Str::endsWith($inspection->file, ['.jpg', '.jpeg', '.png', '.gif']);
@endphp

@if ($isImage)
    <img src="{{ asset('storage/' . $inspection->file) }}" 
         alt="{{ $inspection->file }}" 
         class="w-64 h-64 object-cover rounded-xl border border-gray-300 shadow-sm">
@else
    <a href="{{ asset('storage/' . $inspection->file) }}" target="_blank" 
       class="text-blue-600 underline">Lihat File</a>
@endif

        </div>

   <div class="flex-1 space-y-3 text-gray-800">
            <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $inspection->site->name }}</p>
            <p><strong class="font-semibold text-gray-700">Nama:</strong> {{ $inspection->user->name }}</p>
            <p><strong class="font-semibold text-gray-700">Type:</strong>{{ $inspection->type }}</p>    
            <p><strong class="font-semibold text-gray-700">Corecctive Action:</strong>{{ $inspection->corrective_action }}</p>
            <p><strong class="font-semibold text-gray-700">Inspection Date:</strong>{{ $inspection->date->format('d-m-Y') }}</p>
               <p>
                <span class="font-semibold text-gray-700">Status Accident:</span>
                <span class="px-3 py-1 rounded-full 
                    {{ $inspection->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($inspection->status) }}
                </span>
            </p>
             <p><strong class="font-semibold text-gray-700">Notes:</strong>{{ $inspection->notes }}</p>
        </div>
</div>

<div>
   <a href="{{ route('admin.inspection.index') }}" class="btn btn-secondary mb-4">Kembali</a>
</div>

@endsection