@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="max-w-2xl mx-auto mt-10">

        <h1 class="text-2xl font-bold mb-4">Detail Certification</h1>

        <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6 
                flex flex-col md:flex-row-reverse md:items-center gap-8">
                 @php
                            $isExpiring = $certification->expired_date->diffInDays(now()) <= 30 && $certification->expired_date->isFuture();
                            $isExpired = $certification->expired_date->isPast();
                        @endphp

            <div class="flex-1 space-y-3 text-gray-800">
                <p><strong class="font-semibold text-gray-700">Sites:</strong> {{ $certification->site->name }}</p>
                <p></p><strong class="font-semibold text-gray-700">Nama:</strong> {{ $certification->user->name }}</p>
                <p><strong class="font-semibold text-gray-700">Nama Certification:</strong>{{ $certification->name }}</p>
                <p><strong class="font-semibold text-gray-700">Type:</strong>{{ $certification->type }}</strong></p>
                <p><strong class="font-semibold text-gray-700">Provider:</strong>{{ $certification->provider }}</strong></p>
                <p><strong class="font-semibold text-gray-700">Expired Date:</strong>
                   <span class=" @if($isExpired) text-red-600 font-semibold
                    @elseif($isExpiring) text-yellow-600 font-semibold
                    @else text-gray-700 @endif">
                    {{ $certification->expired_date->format('d-m-Y') }}
                </span>
                </p>

</div>

    </div>
<div>
    <a href="{{ route('admin.certification.index') }}" class="btn btn-secondary mb-4">Back</a>
</div>

@endsection