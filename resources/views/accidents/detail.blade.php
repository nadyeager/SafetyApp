@extends('layouts.app')

@section('title', 'Detail Accident')
@section('content')
<div class="container">
    <h2>Detail Accident</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ $accident->date }}</p>
            <p><strong>Tipe:</strong> {{ ucfirst($accident->type) }}</p>
            <p><strong>Deskripsi:</strong> {{ $accident->description }}</p>
            <p><strong>Status Accident:</strong> {{ ucfirst($accident->status) }}</p>
        </div>
    </div>

    <hr>

    {{-- INVESTIGATION --}}
    @if(!$accident->investigation)
        <h4>Buat Investigation</h4>
        <form action="{{ route('investigations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="accident_id" value="{{ $accident->id }}">

            <div class="mb-3">
                <label>Investigator</label>
                <input type="text" name="investigator" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Root Cause</label>
                <input type="text" name="root_cause" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Corrective Action</label>
                <input type="text" name="corrective_action" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="open">Open</option>
                    <option value="close">Close</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Investigation</button>
        </form>
    @else
        <h4>Investigation</h4>
        <div class="card p-3 mb-3">
            <p><strong>Investigator:</strong> {{ $accident->investigation->investigator }}</p>
            <p><strong>Root Cause:</strong> {{ $accident->investigation->root_cause }}</p>
            <p><strong>Corrective Action:</strong> {{ $accident->investigation->corrective_action }}</p>
            <p><strong>Status:</strong> {{ ucfirst($accident->investigation->status) }}</p>
        </div>

        <a href="{{ route('investigations.edit', $accident->investigation->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('investigations.destroy', $accident->investigation->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
        </form>
    @endif

    <br>
    <a href="{{ route('accidents.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
