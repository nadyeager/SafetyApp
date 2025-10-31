@extends('layouts.navbar-user')

@section('title', 'Certifications')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Certifications</h1>
        <a href="{{ route('certifications.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
            + Buat Certification
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Certification Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Provider</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Expired Date</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($certification as $i => $c)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ optional($c->user)->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ optional($c->site)->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $c->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $c->type }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $c->provider }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($c->expired_date)->format('Y-m-d') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                Belum ada certification.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Jika kamu pakai pagination --}}
    @if (method_exists($certification, 'links'))
        <div class="mt-4">
            {{ $certification->links() }}
        </div>
    @endif
@endsection
