@extends('layouts.navbar')

@section('content')
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-8">Detail Assessment</h1>

        <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6
        flex flex-col md:flex-row-reverse md:items-center gap-8">

        <div class="flex-shrink-0 flex justify-center md:justify-end">
            @php 
                $isImage = Str::endsWith($assessment->file, ['.jpg', '.jpeg', '.png', '.gif']);
            @endphp

            @if ($isImage)
                <img src="{{ asset('storage/' . $assessment->file) }}" alt="{{ $assessment->file }}" class="w-64 h-64 object-cover rounded-xl border border-gray-300 shadow-sm">
            @else
                <a href="{{ asset('storage/' . $assessment->file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
            @endif
        </div>

            <div class="flex-1 space-y-3 text-gray-800">
                <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $assessment->site->name }}</p>
                <p><strong class="font-semibold text-gray-700">Nama:</strong> {{ $assessment->user->name }}</p>
                <p><strong class="font-semibold text-gray-700">Type:</strong>{{ $assessment->type }}</p>
                <p><strong class="font-semibold text-gray-700">Score:</strong>{{ $assessment->score }}</p>
                <p><strong class="font-semibold text-gray-700">Date:</strong>{{ $assessment->date->format('d-m-Y') }}</p>
            </div>
        </div>

        <div  class="mt-6 text-center">
            <a href="{{ route('admin.assessment.index') }}" class="btn btn-secondary mb-4">Kembali</a>
    </div>
</div>


@endsection