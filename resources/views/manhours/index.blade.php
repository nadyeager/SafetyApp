@extends('layouts.navbar-user')

@section('title', 'Manhours')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold text-gray-900">Manhours</h1>
    <a href="{{ route('manhours.create') }}" 
       class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        + Add Manhours
    </a>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

{{-- TABLE WRAPPER --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sites</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Hours</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Month</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Year</th>
                    <!-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th> -->
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($manhour as $mh)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mh->site->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mh->type }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mh->total_hours }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mh->month }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mh->year }}</td>
                        <td class="px-4 py-3 text-sm">
                            <!-- <div class="flex space-x-3">
                                <a href="{{ route('manhours.edit', $mh) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                                <form action="{{ route('manhours.destroy', $mh) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin mau hapus?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div> -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data manhours.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $manhour->links() }}
</div>
@endsection
