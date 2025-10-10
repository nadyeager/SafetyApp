@extends('layouts.app')

@section('title', 'Manpowers')

@section('content')

<a href="{{ route('manpowers.create') }}" class="btn btn-primary">+ Add Manpowers</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Sites</th>
            <th>Type</th>
            <th>Gender</th>
            <th>Total</th>
            <th>Month</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($manpower as $mp )
        <tr>
            <td>{{ $mp->site->name }}</td>
            <td>{{ $mp->type }}</td>
            <td>{{ $mp->gender }}</td>
            <td>{{ $mp->total }}</td>
            <td>{{ $mp->month }}</td>
            <td>{{ $mp->year }}</td>
            <td>
                <a href="{{ route('manpowers.edit', $mp) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('manpowers.destroy', $mp) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</button>
                </form>
            </td>
        </tr>
             @endforeach
    </tbody>
</table>

{{ $manpower->links() }}
</div>
@endsection
 
    