@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4 text-black">Daftar User</h2>

<table class="min-w-full bg-white shadow rounded text-black">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Site</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr class="hover:bg-gray-100">
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">{{ $user->sites->name ?? '-' }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.user.edit', $user->id) }}" 
                   class="text-blue-600 hover:underline">
                    Edit Site
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-4 text-gray-400">
                Tidak ada user dengan role <strong>user</strong>.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
