@extends('layouts.navbar-user')

@section('title', 'Trainings')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold text-gray-900">Trainings</h1>
    <a href="{{ route('trainings.create') }}" 
       class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        + Buat Training
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

{{-- WRAPPER UNTUK RESPONSIVE TABLE --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Provider</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Expired Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Site</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created By</th>
                    <!-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th> -->
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($trainings as $i => $training) 
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $trainings->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $training->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($training->type) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $training->provider ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $training->expired_date ? \Carbon\Carbon::parse($training->expired_date)->format('Y-m-d') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($training->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($training->user)->name ?? '-' }}</td>
                        <!-- <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('trainings.edit', $training) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <form action="{{ route('trainings.destroy', $training) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus training ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                </form>
                            </div>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada training.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $trainings->links() }}
</div>
@endsection
