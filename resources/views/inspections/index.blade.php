@extends('layouts.app')

@section('title', 'Inspections')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold text-gray-900">Inspections</h1>
    <a href="{{ route('inspections.create') }}" 
       class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
        + Buat Inspeksi
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-md rounded-lg">
    {{-- WRAPPER UNTUK RESPONSIVE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Site</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Inspector</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($inspections as $i => $inspection)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $inspections->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($inspection->date, 10) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($inspection->type) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($inspection->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($inspection->user)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($inspection->status === 'open')
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full font-medium">Open</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full font-medium">Close</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm flex space-x-3">
                            <a href="{{ route('inspections.edit', $inspection) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Edit
                            </a>
                            <form action="{{ route('inspections.destroy', $inspection) }}" method="POST" onsubmit="return confirm('Hapus inspeksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada inspeksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $inspections->links() }}
</div>
@endsection
