@extends('layouts.app')

@section('title', 'Assessments')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Assessments</h1>
        <a href="{{ route('assessments.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Buat Assessment</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Score</th>
                    <th class="px-4 py-2">Site</th>
                    <th class="px-4 py-2">Inspector</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($assessments as $i => $assessment)
                    <tr>
                        <td class="px-4 py-3 text-sm">{{ $assessments->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($assessment->date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 text-sm">{{ $assessment->type }}</td>
                        <td class="px-4 py-3 text-sm">{{ number_format($assessment->score, 2) }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($assessment->site)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($assessment->user)->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm space-x-2">
                            <a href="{{ route('assessments.edit', $assessment) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('assessments.destroy', $assessment) }}" method="POST" class="inline" onsubmit="return confirm('Hapus assessment ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada assessment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $assessments->links() }}</div>
@endsection
