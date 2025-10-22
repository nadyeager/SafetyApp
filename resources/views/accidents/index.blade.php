@extends('layouts.navbar-user')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Accidents</h1>

    <a href="{{ route('accidents.create') }}" class="btn btn-primary">+ Add Accident</a>
    <div class="overflow-x-auto">
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accidents as $accident)
            <tr>
                <td>{{ $loop->iteration }}</td>    
                <td>{{ $accident->category }}</td>
                <td>{{ $accident->type }}</td>
                <td>{{ $accident->description }}</td>
                <td>{{ $accident->date }}</td>
                <td>
                    <img src="{{ asset('storage/' . $accident->image) }}" alt="{{ $accident->image }}" width="100">
                </td>
                <td>{{ $accident->status }}</td>
                <td>
                    <a href="{{ route('accidents.edit', $accident) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('accidents.destroy', $accident) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</button>
                    </form>
                    <a href="{{ route('accidents.show', $accident->id) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    {{ $accidents->links() }}
</div>
@endsection
