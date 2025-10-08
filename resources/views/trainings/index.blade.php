@extends('layouts.app')

@section('title', 'Trainings')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-900">Trainings</h1>
        <a href="{{ route('trainings.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Buat Training
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Provider</th>
                    <th class="px-4 py-2">Expired Date</th>
                    <th class="px-4 py-2">Site</th>
                    <th class="px-4 py-2">Created By</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($trainings as $i => $training)
                    <tr>
                        <td class="px-4 py-3 text-sm">{{ $trainings->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm">{{ $training->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ ucfirst($training->type) }}</td>
                        <td class="px-4 py-3 text-sm">{{ $training->provider ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $training->expired_date ? \Carbon\Carbon::parse($training->expired_date)->format('Y-m-d') : '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($training->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($training->user)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm space-x-2">
                            <a href="{{ route('trainings.edit', $training) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('trainings.destroy', $training) }}" method="POST" class="inline" onsubmit="return confirm('Hapus training ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada training.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $trainings->links() }}
    </div>
@endsection
