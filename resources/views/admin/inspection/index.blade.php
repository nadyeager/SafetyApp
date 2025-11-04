@extends('layouts.navbar')

@section('content')
<div class="container mx-auto px-4 py-6">

   
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <span class="text-blue-600">Inspection</span> Information
        </h1>
    </div>

  
    <form action="{{ route('admin.inspection.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <label for="month" class="text-gray-600 font-medium">Filter by Month:</label>
            <input type="month" name="month" id="month"
                value="{{ request('month', now()->format('Y-m')) }}"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">Show</button>
        </div>
    </form>

 
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
            <p class="text-gray-500 text-sm mb-2">Management - Open</p>
            <h3 class="text-2xl font-bold text-blue-700">{{ $managementOpen }}</h3>
        </div>
        <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
            <p class="text-gray-500 text-sm mb-2">Management - Closed</p>
            <h3 class="text-2xl font-bold text-green-700">{{ $managementClose }}</h3>
        </div>
        <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
            <p class="text-gray-500 text-sm mb-2">Routine - Open</p>
            <h3 class="text-2xl font-bold text-blue-700">{{ $routineOpen }}</h3>
        </div>
        <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
            <p class="text-gray-500 text-sm mb-2">Routine - Closed</p>
            <h3 class="text-2xl font-bold text-green-700">{{ $routineClose }}</h3>
        </div>
    </div>

   
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif


    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Management Inspection</h2>
        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        @foreach(['No', 'Type', 'Corrective Action', 'Inspection Date', 'Created at', 'Status', 'Notes', 'Action', 'Updated at'] as $head)
                            <th class="px-4 py-2 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($management as $m)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $m->type }}</td>
                            <td class="border px-4 py-2">{{ $m->corrective_action }}</td>
                            <td class="border px-4 py-2">{{ $m->date->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $m->created_at->format('d-m-Y') }}</td>
                             <td class="border px-4 py-2">
                                    <span class="status-btn cursor-pointer font-medium {{ $m->status == 'open' ? 'text-blue-600' : 'text-gray-400' }}" data-id="{{ $m->id }}">
                                        {{ ucfirst($m->status ?? '-') }}
                                    </span>
                                </td>
                            <td class="border px-4 py-2 text-gray-600">{{ Str::limit($m->notes, 40) }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <button class="text-yellow-600 hover:underline"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editNotesModal{{ $m->id }}">
                                    Edit Notes
                                </button>
                                <a href="{{ route('admin.inspection.show', $m->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.inspection.edit', $m->id) }}" class="text-green-600 hover:underline">Edit</a>
                            </td>
                            <td class="border px-4 py-2 text-gray-500">{{ $m->updated_at->format('d-m-Y') }}</td>
                        </tr>

                       
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="9" class="text-center text-gray-500 py-3">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

   
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Routine Inspection</h2>
        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        @foreach(['No', 'Type', 'Corrective Action', 'Inspection Date', 'Created at', 'Status', 'Notes', 'Action', 'Updated at'] as $head)
                            <th class="px-4 py-2 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($routine as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $r->type }}</td>
                            <td class="border px-4 py-2">{{ $r->corrective_action }}</td>
                            <td class="border px-4 py-2">{{ $r->date->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $r->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">
                                    <span class="status-btn cursor-pointer font-medium {{ $r->status == 'open' ? 'text-blue-600' : 'text-gray-400' }}" data-id="{{ $r->id }}">
                                        {{ ucfirst($r->status ?? '-') }}
                                    </span>
                                </td>
                            <td class="border px-4 py-2 text-gray-600">{{ Str::limit($r->notes, 40) }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <button class="text-yellow-600 hover:underline"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editNotesModalR{{ $r->id }}">
                                    Edit Notes
                                </button>
                                <a href="{{ route('admin.inspection.show', $r->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.inspection.edit', $r->id) }}" class="text-green-600 hover:underline">Edit</a>
                            </td>
                            <td class="border px-4 py-2 text-gray-500">{{ $r->updated_at->format('d-m-Y') }}</td>
                        </tr>

                        {{-- Modal Edit Notes --}}
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="9" class="text-center text-gray-500 py-3">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.status-btn').forEach(el => {
        el.addEventListener('click', function() {
            const id = this.dataset.id;
            const currentStatus = this.textContent.trim().toLowerCase();
            if (currentStatus !== 'open') return;

            const newStatus = 'close';
            this.textContent = newStatus;
            this.classList.remove('text-blue-600');
            this.classList.add('text-gray-400');

            fetch(`/update-status/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert('Gagal update status!');
                    this.textContent = 'Open';
                    this.classList.add('text-blue-600');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan!');
                this.textContent = 'Open';
                this.classList.add('text-blue-600');
            });
        });
    });
});
</script>
@endsection
