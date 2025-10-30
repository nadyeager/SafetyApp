@extends('layouts.navbar-user')

@section('title', 'Detail Accident')
@section('content')
<div class="container">
    <h2>Detail Accident</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Sites:</strong> {{ $accident->site->name }}</p>
            <p><strong>Nama:</strong> {{ $accident->user->name }}</p>
            <p><strong>Category:</strong>{{ $accident->category }}</p>
             <p><strong>Tipe:</strong> {{ ucfirst($accident->type) }}</p>
             <p><strong>Deskripsi:</strong> {{ $accident->description }}</p>
            <p><strong>Tanggal:</strong> {{ $accident->date }}</p>
           <p>
            <img src="{{ asset('storage/' . $accident->file) }}" alt="{{ $accident->file }}" width="100">
           </p>
            <p><strong>Status Accident:</strong> {{ ucfirst($accident->status) }}</p>
        </div>
    </div>

    <br>
    <a href="{{ route('accidents.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
