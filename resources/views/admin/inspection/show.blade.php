@extends('layouts.navbar-admin')

@section('content')
<div class="container">
    <h1>Detail Inspection</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Sites:</strong> {{ $inspection->site->name }}</p>
            <p><strong>Nama:</strong> {{ $inspection->user->name }}</p>
            <p><strong>Type:</strong>{{ $inspection->type }}</p>    
            <p><strong>Corecctive Action:</strong>{{ $inspection->corrective_action }}</p>
            <p><strong>Inspection Date:</strong>{{ $inspection->date->format('d-m-Y') }}</p>
            <p><strong>Created At:</strong>{{ $inspection->created_at->format('d-m-Y') }}</p>
            <p><strong>Status:</strong>{{ $inspection->status }}</p>
             <p><strong>Notes:</strong>{{ $inspection->notes }}</p>
        </div>
</div>

<div>
   <a href="{{ route('admin.inspection.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection