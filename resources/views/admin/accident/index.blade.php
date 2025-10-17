@extends('layouts.navbar-admin')

@section('content')
    <div class="container">
        <h1>Laporan Semua Accidents</h1>
        <form method="GET" action="{{ route('admin.accident.filter') }}" class="mb-4 d-flex gap-2">
            <select name="status" class="form-select w-auto">
                <option value="">Semua Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                 <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
            </select>

            <select name="type" class="form-select w-auto">
                <option value="">Semua Type</option>
                <option value="Fatality" {{ request('type') == 'Fatality' ? 'selected' : '' }}>Fatality</option>
                <option value="Major injury" {{ request('type') == 'Major injury' ? 'selected' : '' }}>Major injury</option>
                <option value="Minor injury" {{ request('type') == 'Minor injury' ? 'selected' : '' }}>Minor injury</option>
                <option value="Traffic Accident" {{ request('type') == 'Traffic Accident' ? 'selected' : '' }}>Traffic Accident</option>
                <option value="Non Work Accident" {{ request('type') == 'Non Work Accident' ? 'selected' : '' }}>Non Work Accident</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.accident.filter') }}" class="btn btn-secondary">Reset</a>


               
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sites</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Date</th>
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
                        <td>{{ $a->date }}</td>
                        <td>
                            <span class="status-btn" data-id="{{ $a->id }}" style="cursor:pointer; color:blue;"> {{ $a->status }}</span></td>
                        <td>
                            <a href="{{ route('investigations.create', $a->id) }}" class="btn btn-sm btn-info">Investigate</a>
                            <a href="{{ route('admin.accident.show', $a->id) }}" class="btn btn-sm btn-info">View</a>
                          
                        </td>

                    </tr>  
                </tbody>
                 @endforeach
        </table>
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.status-btn').forEach(el => {
            el.addEventListener('click', function() {
                const id = this.dataset.id;
                const currentStatus = this.textContent.trim();
                const newStatus = currentStatus === 'open' ? 'close' : 'open';

                this.textContent = newStatus;

                fetch(`/update-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: newStatus})
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert('Gagal update status!');
                        this.textContent = currentStatus;
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan!');
                    this.textContent = currentStatus;
                });
            });
        });
    });
   </script>
@endsection