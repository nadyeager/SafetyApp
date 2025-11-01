@extends('layouts.navbar')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-bold text-indigo-600">Daftar User</h2>
</div>

<div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-800 border-collapse">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3 border-b text-left">Nama</th>
                    <th class="px-6 py-3 border-b text-left">Email</th>
                    <th class="px-6 py-3 border-b text-left">Site</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-gray-700">
                            {{ $user->site->name ?? '-' }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11 17h2m-1-1v-6m-6 6h12M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Edit Site
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500 italic">
                            Tidak ada user dengan role <strong>user</strong>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
