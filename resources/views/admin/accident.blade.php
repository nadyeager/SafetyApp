@extends('layouts.navbar-admin')

@section('content')
    <div class="container">
        <h1>Laporan Semua Accidents</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sites</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($accidents as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $a->site->name }}</td>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->type }}</td>
                        <td>{{ $a->description }}</td>
                        <td>{{ $a->date }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $a->image) }}" alt="{{ $a->image }}" width="100">
                        </td>
                        <td>{{ $a->status }}</td>
                        <td>
                            <a href="{{ route('investigations.create') }}" class="btn btn-sm btn-info">Investigate</a>
                        </td>
                    </tr>  
                </tbody>
                 @endforeach
        </table>
    </div>
@endsection