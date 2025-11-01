@extends('layouts.navbar')

@section('content')
<div class="container mx-auto px-4 py-6">

   
    <h1 class="text-3xl font-bold mb-6 text-gray-900">
        <span class="text-green-600">EHS Training & Development</span> Information
    </h1>


    <div class="bg-white shadow-sm border border-gray-100 rounded-xl p-4 mb-6 flex flex-wrap items-center gap-3">
        <form method="GET" action="{{ route('admin.training.filter') }}" class="flex flex-wrap items-center gap-3">
            <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option value="">All Types</option>
                <option value="mandatory" {{ request('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
                <option value="non-mandatory" {{ request('type') == 'non-mandatory' ? 'selected' : '' }}>Non Mandatory</option>
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Filter
            </button>

            <a href="{{ route('admin.training.filter') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Reset
            </a>
        </form>
    </div>

 
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Mandatory Trainings</p>
            <h3 class="text-3xl font-bold text-green-700">{{ $total_mandatory }}</h3>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Non Mandatory Trainings</p>
            <h3 class="text-3xl font-bold text-blue-700">{{ $total_non_mandatory }}</h3>
        </div>
    </div>

   
    <section class="mb-10">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-800">Mandatory Trainings</h2>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        @foreach(['No', 'Site', 'User', 'Training Name', 'Type', 'Provider', 'Action'] as $head)
                            <th class="px-4 py-3 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mandatory as $c)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $c->site->name }}</td>
                            <td class="border px-4 py-2">{{ $c->user->name }}</td>
                            <td class="border px-4 py-2 font-medium text-gray-800">{{ $c->name }}</td>
                            <td class="border px-4 py-2 text-green-700 font-semibold capitalize">{{ $c->type }}</td>
                            <td class="border px-4 py-2 text-gray-600">{{ $c->provider }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.training.edit', $c->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-3 text-gray-500">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

   
    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-800">Non Mandatory Trainings</h2>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        @foreach(['No', 'Site', 'User', 'Training Name', 'Type', 'Provider', 'Action'] as $head)
                            <th class="px-4 py-3 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($non_mandatory as $c)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $c->site->name }}</td>
                            <td class="border px-4 py-2">{{ $c->user->name }}</td>
                            <td class="border px-4 py-2 font-medium text-gray-800">{{ $c->name }}</td>
                            <td class="border px-4 py-2 text-blue-700 font-semibold capitalize">{{ $c->type }}</td>
                            <td class="border px-4 py-2 text-gray-600">{{ $c->provider }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.training.edit', $c->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-3 text-gray-500">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>
@endsection
