@extends('layouts.navbar-admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    <span class="text-blue-600">Inspection</span> Information
</h1>

{{-- 🔹 Filter Bulan --}}
<form action="{{ route('admin.inspection.index') }}" method="GET">
    <div class="d-flex align-items-center gap-2 mb-4">
        <label for="month">Pilih Bulan</label>
        <input type="month" name="month" id="month" 
               value="{{ request('month', now()->format('Y-m')) }}" 
               class="form-control w-auto">
        <button class="btn btn-primary">Tampilkan</button>
    </div>
</form>

{{-- 🔹 Statistik Ringkas --}}
<div class="space-y-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white shadow rounded-xl p-4">
            <h6>Management - Open</h6>
            <h3>{{ $managementOpen }}</h3>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h6>Management - Closed</h6>
            <h3>{{ $managementClose }}</h3>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h6>Routine - Open</h6>
            <h3>{{ $routineOpen }}</h3>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h6>Routine - Closed</h6>
            <h3>{{ $routineClose }}</h3>
        </div>
    </div>
</div>

{{-- 🔹 Alert Sukses --}}
@if (session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

{{-- 🔹 Tabel Management Inspection --}}
<div>
    <h1 class="text-xl font-bold mb-4 mt-4">Management Inspection</h1>
    <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Corrective Action</th>
                <th>Inspection Date</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($management as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->type }}</td>
                <td>{{ $m->corrective_action }}</td>
                <td>{{ $m->date->format('d-m-Y') }}</td>
                <td>{{ $m->created_at->format('d-m-Y') }}</td>
                <td>{{ $m->status }}</td>
                <td>{{ Str::limit($m->notes, 40) }}</td>
                <td>
                    <button class="btn btn-sm btn-secondary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editNotesModal{{ $m->id }}">
                        Edit Notes
                    </button>
                    <a href="{{ route('admin.inspection.show', $m->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('admin.inspection.edit', $m->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
                <td>{{ $m->updated_at->format('d-m-Y') }}</td>
            </tr>

            {{-- Modal Edit Notes --}}
            <div class="modal fade" id="editNotesModal{{ $m->id }}" tabindex="-1" aria-labelledby="editNotesLabel{{ $m->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.inspection.updateNotes', $m->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="editNotesLabel{{ $m->id }}">Edit Notes - {{ $m->type }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="notes{{ $m->id }}" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes{{ $m->id }}" class="form-control" rows="4">{{ $m->notes }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal --}}

            @empty
            <tr><td colspan="9" class="text-center">No data available</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- 🔹 Tabel Routine Inspection --}}
<div>
    <h1 class="text-xl font-bold mb-4 mt-8">Routine Inspection</h1>
    <table class="w-full border mb-6 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Corrective Action</th>
                <th>Inspection Date</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($routine as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->type }}</td>
                <td>{{ $r->corrective_action }}</td>
                <td>{{ $r->date->format('d-m-Y') }}</td>
                <td>{{ $r->created_at->format('d-m-Y') }}</td>
                <td>{{ $r->status }}</td>
                <td>{{ Str::limit($r->notes, 40) }}</td>
                <td>
                    <button class="btn btn-sm btn-secondary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editNotesModalR{{ $r->id }}">
                        Edit Notes
                    </button>
                    <a href="{{ route('admin.inspection.show', $r->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('admin.inspection.edit', $r->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
                <td>{{ $r->updated_at->format('d-m-Y') }}</td>
            </tr>

            {{-- Modal Edit Notes Routine --}}
            <div class="modal fade" id="editNotesModalR{{ $r->id }}" tabindex="-1" aria-labelledby="editNotesLabelR{{ $r->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.inspection.updateNotes', $r->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="editNotesLabelR{{ $r->id }}">Edit Notes - {{ $r->type }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="notesR{{ $r->id }}" class="form-label">Notes</label>
                                    <textarea name="notes" id="notesR{{ $r->id }}" class="form-control" rows="4">{{ $r->notes }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal --}}
            @empty
            <tr><td colspan="9" class="text-center">No data available</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
