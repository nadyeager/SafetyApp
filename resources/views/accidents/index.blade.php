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

         @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Category</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Type</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Description</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                File</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action</th>
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
    @if($accident->file)
        @if(Str::endsWith($accident->file, ['.jpg', '.jpeg', '.png', '.gif']))
            <img src="{{ asset('storage/' . $accident->file) }}" alt="File" class="h-12 rounded">
        @elseif(Str::endsWith($accident->file, '.pdf'))
            <a href="{{ asset('storage/' . $accident->file) }}" target="_blank" class="text-blue-600 underline">View PDF</a>
        @else
            <a href="{{ asset('storage/' . $accident->file) }}" target="_blank" class="text-gray-600 underline">Download File</a>
        @endif
    @else
        <span class="text-gray-400 italic">No file</span>
    @endif
</td>

                                <td class="px-4 py-3 text-sm text-gray-700">{{ $accident->status }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('accidents.edit', $accident) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                                <!-- <a href="{{ route('accidents.show', $accident) }}"
                                   class="text-green-600 hover:text-green-800 font-medium">
                                   Detail
                                </a>
                                <form action="{{ route('accidents.destroy', $accident) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus accident ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form> -->
                            </div>
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