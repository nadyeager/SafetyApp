@extends('layouts.app')



@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-900">Inspections</h1>
        <a href="{{ route('inspections.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Buat Inspeksi
        </a>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-200 text-bold text-white ">
                <tr>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">No</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Date</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Type</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Site</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Inspector</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Status</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($inspections as $i => $inspection)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $inspections->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($inspection->date, 10) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($inspection->type) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($inspection->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($inspection->user)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($inspection->status === 'open')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Open</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Close</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 space-x-2">
                            <a href="{{ route('inspections.edit', $inspection) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('inspections.destroy', $inspection) }}" method="POST" class="inline" onsubmit="return confirm('Hapus inspeksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada inspeksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $inspections->links() }}
    </div>
@endsection
