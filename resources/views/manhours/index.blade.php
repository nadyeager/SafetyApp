@extends('layouts.app')

@section('title', 'Manhours')

@section('content')

<a href="{{ route('manhours.create') }}" class="btn btn-primary">+ Add Manhours</a>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Sites</th>
                        <th>Type</th>
                        <th>Total Hours</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manhour as $mh )
                    <tr>
                        <td>{{ $mh->site->name }}</td>
                        <td>{{ $mh->type }}</td>
                        <td>{{ $mh->total_hours }}</td>
                        <td>{{ $mh->month }}</td>
                        <td>{{ $mh->year }}</td>
                        <td>
                            <a href="{{ route('manhours.edit', $mh) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('manhours.destroy', $mh) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $manhour->links() }}
           </div>
@endsection