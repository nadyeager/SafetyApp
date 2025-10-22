@extends('layouts.navbar-user')

@section('title', 'Safety Activities')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Safety Activities</h1>
    <a href="{{ route('safety-activities.create') }}" 
       class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        + Buat Activity
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
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Site</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">User</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Notes</th>
                    <!-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th> -->
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($safetyActivities as $i => $act)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $safetyActivities->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($act->date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $act->type }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($act->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($act->user)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($act->notes, 80) }}</td>
                        <!-- <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('safety-activities.edit', $act) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <form action="{{ route('safety-activities.destroy', $act) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus activity ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada activity.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $safetyActivities->links() }}
</div>
@endsection
