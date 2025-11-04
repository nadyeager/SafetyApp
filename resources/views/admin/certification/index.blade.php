@extends('layouts.navbar')

@section('content')
<div class="container mx-auto px-4 py-6">

  
    <h1 class="text-3xl font-bold mb-6 text-gray-900">
        <span class="text-yellow-600">EHS Certification Development</span> Information
    </h1>

   
    <div class="bg-white shadow-sm border border-gray-100 rounded-xl p-4 mb-6 flex flex-wrap items-center gap-3">
        <form method="GET" action="{{ route('admin.certification.filter') }}" class="flex flex-wrap items-center gap-3">
            <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                <option value="">All Types</option>
                <option value="mandatory" {{ request('type') == 'mandatory' ? 'selected' : '' }}>Mandatory</option>
                <option value="non-mandatory" {{ request('type') == 'non-mandatory' ? 'selected' : '' }}>Non Mandatory</option>
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Filter
            </button>

            <a href="{{ route('admin.certification.filter') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Reset
            </a>
        </form>
    </div>

 
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Mandatory Certifications</p>
            <h3 class="text-3xl font-bold text-green-700">{{ $total_mandatory }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Non Mandatory Certifications</p>
            <h3 class="text-3xl font-bold text-blue-700">{{ $total_non_mandatory }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="clock" class="w-6 h-6 text-yellow-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Expiring Soon</p>
            <h3 class="text-3xl font-bold text-yellow-700">{{ $expiring_soon }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-3 text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-2">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
            </div>
            <p class="text-gray-500 text-sm">Expired</p>
            <h3 class="text-3xl font-bold text-red-700">{{ $expired }}</h3>
        </div>
    </div>

   
    <section class="mb-10">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-800">Mandatory Certifications</h2>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        @foreach(['No', 'Site', 'User', 'Certification Name', 'Type', 'Provider', 'Expired Date', 'Created at', 'Updated at', 'Action'] as $head)
                            <th class="px-4 py-3 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mandatory as $c)
                        @php
                            $isExpiring = $c->expired_date->diffInDays(now()) <= 30 && $c->expired_date->isFuture();
                            $isExpired = $c->expired_date->isPast();
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $c->site->name }}</td>
                            <td class="border px-4 py-2">{{ $c->user->name }}</td>
                            <td class="border px-4 py-2 font-medium text-gray-800">{{ $c->name }}</td>
                            <td class="border px-4 py-2 text-green-700 font-semibold capitalize">{{ $c->type }}</td>
                            <td class="border px-4 py-2 text-gray-600">{{ $c->provider }}</td>
                            <td class="border px-4 py-2">
                                <span class="@if($isExpired) text-red-600 font-semibold 
                                             @elseif($isExpiring) text-yellow-600 font-medium 
                                             @else text-gray-700 @endif">
                                    {{ $c->expired_date->format('d-m-Y') }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">{{ $c->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $c->updated_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.certification.edit', $c->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                                <a href="{{ route('admin.certification.show', $c->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 font-medium p-2">
                                    Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-3 text-gray-500">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

  
    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-800">Non Mandatory Certifications</h2>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        @foreach(['No', 'Site', 'User', 'Certification Name', 'Type', 'Provider', 'Expired Date', 'Created at', 'Updated at', 'Action'] as $head)
                            <th class="px-4 py-3 border">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($non_mandatory as $c)
                        @php
                            $isExpiring = $c->expired_date->diffInDays(now()) <= 30 && $c->expired_date->isFuture();
                            $isExpired = $c->expired_date->isPast();
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $c->site->name }}</td>
                            <td class="border px-4 py-2">{{ $c->user->name }}</td>
                            <td class="border px-4 py-2 font-medium text-gray-800">{{ $c->name }}</td>
                            <td class="border px-4 py-2 text-blue-700 font-semibold capitalize">{{ $c->type }}</td>
                            <td class="border px-4 py-2 text-gray-600">{{ $c->provider }}</td>
                            <td class="border px-4 py-2">
                                <span class="@if($isExpired) text-red-600 font-semibold 
                                             @elseif($isExpiring) text-yellow-600 font-medium 
                                             @else text-gray-700 @endif">
                                    {{ $c->expired_date->format('d-m-Y') }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">{{ $c->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $c->updated_at->format('d-m-Y') }}</td>
                              <td class="border px-4 py-2">
                                <a href="{{ route('admin.certification.edit', $c->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                   Edit
                                </a>
                                <a href="{{ route('admin.certification.show', $c->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 font-medium p-2">
                                    Detail</a>
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
