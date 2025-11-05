@extends('layouts.navbar')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Detail Accident</h2>

    <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-7 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center gap-8">
            <div class="flex-shrink-0">
                @php
                    $isImage = Str::endsWith($accident->file, ['.jpg', '.jpeg', '.png', '.gif']);
                @endphp

                @if ($isImage)
                    <img src="{{ asset('storage/' . $accident->file) }}" alt="{{ $accident->file }}" class="w-64 h-64 object-cover rounded-lg border border-gray-300 shadow" />
                @else
                    <a href="{{ asset('storage/' . $accident->file) }}" target="_blank" class="text-blue-600 underline text-sm">Lihat Lampiran</a>
                @endif
            </div>

            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">

                <p><span class="font-semibold">Site :</span> {{ $accident->site->name }}</p>
                <p><span class="font-semibold">Name :</span> {{ $accident->user->name }}</p>
                <p><span class="font-semibold">Category :</span> {{ $accident->category }}</p>
                <p><span class="font-semibold">Type :</span> {{ ucfirst($accident->type) }}</p>
                <p><span class="font-semibold">Date :</span> {{ $accident->date->format('d-m-Y') }}</p>
                <p><span class="font-semibold">Status :</span>
                    <span class="px-3 py-1 rounded-full text-sm {{ $accident->status === 'open' ? 'bg-yellow-100 text-yellow-800' : ($accident->status === 'progress' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                        {{ ucfirst($accident->status) }}
                    </span>
                </p>
                <p><span class="font-semibold">Created :</span> {{ $accident->created_at->format('d-m-Y') }}</p>
                <p><span class="font-semibold">Updated :</span> {{ $accident->updated_at->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-200">
            <p class="font-semibold text-gray-800 mb-2">Description:</p>
            <p class="bg-gray-50 p-4 rounded-lg border border-gray-200 leading-relaxed text-gray-700">{{ $accident->description }}</p>
        </div>
    </div>

    <div class="mt-8 text-center flex justify-center gap-3">
        <a href="{{ route('admin.accident.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition">Kembali</a>
    </div>
</div>
@endsection