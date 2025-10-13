@extends('layouts.app')

@section('title', 'Safety Activities')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Safety Activities</h1>
    <a href="{{ route('safety-activities.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Buat Activity</a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white shadow sm:rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left">Site</th>
                <th class="px-4 py-3 text-left">User</th>
                <th class="px-4 py-3 text-left">Notes</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($safetyActivities as $i => $act)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $safetyActivities->firstItem() + $i }}</td>
                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($act->date)->format('Y-m-d') }}</td>
                    <td class="px-4 py-3 text-sm">{{ $act->type }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($act->site)->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($act->user)->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ \Illuminate\Support\Str::limit($act->notes, 80) }}</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route('safety-activities.edit', $act) }}" class="text-blue-600 mr-2">Edit</a>
                        <form action="{{ route('safety-activities.destroy', $act) }}" method="POST" class="inline" onsubmit="return confirm('Hapus activity ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada activity.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $safetyActivities->links() }}
</div>
@endsection
