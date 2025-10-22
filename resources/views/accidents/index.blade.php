@extends('layouts.navbar-user')

@section('title', 'Accidents')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Accidents</h1>
    <a href="{{ route('accidents.create') }}" 
       class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        + Add Accident
    </a>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

{{-- WRAPPER --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <!-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th> -->
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($accidents as $i => $accident)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $accidents->firstItem() + $i }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $accident->type }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $accident->description }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ \Carbon\Carbon::parse($accident->date)->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            @if($accident->image)
                                <img src="{{ asset('storage/' . $accident->image) }}" 
                                     alt="{{ $accident->image }}" 
                                     class="w-16 h-16 object-cover rounded shadow">
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $accident->status }}
                        </td>
                        <!-- <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('accidents.show', $accident->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Detail
                                </a>
                                <a href="{{ route('accidents.edit', $accident) }}" 
                                   class="text-yellow-600 hover:text-yellow-800 font-medium">
                                   Edit
                                </a>
                                <form action="{{ route('accidents.destroy', $accident) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin mau hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data kecelakaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $accidents->links() }}
</div>
@endsection
