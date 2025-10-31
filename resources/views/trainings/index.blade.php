@extends('layouts.navbar-user')

@section('title', 'Trainings')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Trainings</h1>
        <a href="{{ route('trainings.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
            + Buat Training
        </a>
    </div>

    @if (session('success'))
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Site</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Training Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Provider</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($training as $i => $t)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ optional($t->user)->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ optional($t->site)->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $t->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $t->type }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $t->provider }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Belum ada training.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Jika kamu pakai pagination --}}
    @if (method_exists($training, 'links'))
        <div class="mt-4">
            {{ $training->links() }}
        </div>
    @endif
@endsection
