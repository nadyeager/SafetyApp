@extends('layouts.navbar-user')

@section('content')
    <div class="container">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold text-gray-900">Accidents</h1>
            <a href="{{ route('accidents.create') }}"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                + Buat Accident
            </a>
        </div>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">   
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($accidents as $accident)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->category }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->type }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->date }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            <img src="{{ asset('storage/' . $accident->image) }}" alt="{{ $accident->image }}" width="100">
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->status }}</td>
                        <td class="flex space-x-3">    
                            <a href="{{ route('accidents.edit', $accident) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('accidents.destroy', $accident) }}" method="POST"
                                style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin mau hapus?')">Delete</button>
                            </form>
                            <a href="{{ route('accidents.show', $accident->id) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $accidents->links() }}
    </div>
@endsection