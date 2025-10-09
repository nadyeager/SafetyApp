@extends('layouts.app')

@section('title', 'Edit Investigation')
@section('content')
<div class="container">
    <h2>Edit Investigation</h2>

    <form action="{{ route('investigations.update', $investigation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Investigator</label>
            <input type="text" name="investigator" class="form-control" value="{{ $investigation->investigator }}" required>
        </div>

        <div class="mb-3">
            <label>Root Cause</label>
            <input type="text" name="root_cause" class="form-control" value="{{ $investigation->root_cause }}" required>
        </div>

        <div class="mb-3">
            <label>Corrective Action</label>
            <input type="text" name="corrective_action" class="form-control" value="{{ $investigation->corrective_action }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="open" {{ $investigation->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="close" {{ $investigation->status == 'close' ? 'selected' : '' }}>Close</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('accidents.show', $investigation->accident_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
