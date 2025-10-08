@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Accidents</h1>

    <a href="{{ route('accidents.create') }}" class="btn btn-primary">+ Add Accident</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Site</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accidents as $accident)
            <tr>
                <td>{{ $accident->type }}</td>
                <td>{{ $accident->description }}</td>
                <td>{{ $accident->date }}</td>
                <td>{{ $accident->status }}</td>
                <td>{{ $accident->site->name ?? '-' }}</td>
                <td>{{ $accident->user->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('accidents.edit', $accident) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('accidents.destroy', $accident) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $accidents->links() }}
</div>
@endsection
