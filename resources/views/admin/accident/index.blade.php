@extends('layouts.navbar')

@section('content')
<div class="container mx-auto px-4 py-6">

    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            Work <span class="text-red-600">Accident</span> Information
        </h1>
    </div>

   
    <form method="GET" action="{{ route('admin.accident.filter') }}" class="flex flex-wrap gap-3 items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div>
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">All Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
            </select>
        </div>

        <div>
            <select name="category" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">All Categories</option>
                <option value="work accident" {{ request('category') == 'work accident' ? 'selected' : '' }}>Work Accident</option>
                <option value="traffic accident" {{ request('category') == 'traffic accident' ? 'selected' : '' }}>Traffic Accident</option>
                <option value="non-work accident" {{ request('category') == 'non-work accident' ? 'selected' : '' }}>Non Work Accident</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-700 transition">Filter</button>
        <a href="{{ route('admin.accident.filter') }}" class="bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-300 transition">Reset</a>
    </form>

    @php 
        $statsCard = [
            'Total Accidents' => $totalAccidents,
            'Work Accidents' => $totalWorkAccidents,
            'Traffic Accidents' => $totalTrafficAccidents,
            'Non Work Accidents' => $totalNonWorkAccidents,
        ];

        $statsCard2 = [
            'Investigations' => $totalInvestigation,
            'Closed Accidents' => $totalClosedAccidents,
            'Opened Accidents' => $totalOpenedAccidents,
        ];
    @endphp

    <div class="mt-6 space-y-4">
        {{-- FIRST ROW --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($statsCard as $label => $value)
                <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
                    <p class="text-gray-600 text-sm mb-2">{{ $label }}</p>
                    <h3 class="text-2xl font-bold text-blue-700">{{ $value }}</h3>
                </div>
            @endforeach
        </div>

       
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($statsCard2 as $label => $value)
                <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-100 text-center hover:shadow-lg transition">
                    <p class="text-gray-600 text-sm mb-2">{{ $label }}</p>
                    <h3 class="text-2xl font-bold text-green-700">{{ $value }}</h3>
                </div>
            @endforeach
        </div>
    </div>

    {{-- WORK ACCIDENT SECTION --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2">Work Accident</h2>

        @foreach ($workAccidents as $type => $items)
            <div class="mt-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $type }}</h3>
                    <span class="text-sm text-gray-500">{{ count($items ?? []) }} Cases</span>
                </div>

                <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-600">
                            <tr>
                                @foreach(['No', 'Category', 'Type', 'Status', 'Date of Incident', 'Created At', 'Action', 'Updated At'] as $head)
                                    <th class="px-4 py-2 border">{{ $head }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $item->category }}</td>
                                    <td class="border px-4 py-2">{{ $item->type }}</td>
                                    <td class="border px-4 py-2">
                                        <span class="status-btn cursor-pointer font-medium {{ $item->status == 'open' ? 'text-blue-600' : 'text-gray-400' }}" data-id="{{ $item->id }}">
                                            {{ ucfirst($item->status ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2 space-x-2">
                                        <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                        <a href="{{ route('investigations.index', $item->id) }}" class="text-yellow-600 hover:underline">Investigate</a>
                                        <a href="{{ route('admin.accident.edit', $item->id) }}" class="text-green-600 hover:underline">Edit</a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    {{-- TRAFFIC ACCIDENT --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2">Traffic Accident</h2>
        @if(!empty($trafficAccidents) && count($trafficAccidents) > 0)
            <p class="text-sm text-gray-500 mb-2">{{ count($trafficAccidents) }} Cases</p>
            <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            @foreach(['No', 'Category', 'Status', 'Date of Incident', 'Created At', 'Action', 'Updated At'] as $head)
                                <th class="px-4 py-2 border">{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trafficAccidents as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $item->category }}</td>
                                <td class="border px-4 py-2">
                                    <span class="status-btn cursor-pointer font-medium {{ $item->status == 'open' ? 'text-blue-600' : 'text-gray-400' }}" data-id="{{ $item->id }}">
                                        {{ ucfirst($item->status ?? '-') }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                    <a href="{{ route('investigations.index', $item->id) }}" class="text-yellow-600 hover:underline">Investigate</a>
                                    <a href="{{ route('admin.accident.edit', $item->id) }}" class="text-green-600 hover:underline">Edit</a>
                                </td>
                                <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- NON WORK ACCIDENT --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2">Non Work Accident</h2>
        @foreach ($nonWorkAccidents as $type => $items)
            <div class="mt-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $type }}</h3>
                    <span class="text-sm text-gray-500">{{ count($items) }} Cases</span>
                </div>

                <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-600">
                            <tr>
                                @foreach(['No', 'Category', 'Type', 'Status', 'Date of Incident', 'Created At', 'Action', 'Updated At'] as $head)
                                    <th class="px-4 py-2 border">{{ $head }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $item->category }}</td>
                                    <td class="border px-4 py-2">{{ $item->type }}</td>
                                    <td class="border px-4 py-2">
                                        <span class="status-btn cursor-pointer font-medium {{ $item->status == 'open' ? 'text-blue-600' : 'text-gray-400' }}" data-id="{{ $item->id }}">
                                            {{ ucfirst($item->status ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2 space-x-2">
                                        <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                        <a href="{{ route('investigations.index', $item->id) }}" class="text-yellow-600 hover:underline">Investigate</a>
                                        <a href="{{ route('admin.accident.edit', $item->id) }}" class="text-green-600 hover:underline">Edit</a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.status-btn').forEach(el => {
        el.addEventListener('click', function() {
            const id = this.dataset.id;
            const currentStatus = this.textContent.trim().toLowerCase();
            if (currentStatus !== 'open') return;

            const newStatus = 'close';
            this.textContent = newStatus;
            this.classList.remove('text-blue-600');
            this.classList.add('text-gray-400');

            fetch(`/update-status-accident/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert('Gagal update status!');
                    this.textContent = 'Open';
                    this.classList.add('text-blue-600');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan!');
                this.textContent = 'Open';
                this.classList.add('text-blue-600');
            });
        });
    });
});
</script>
@endsection
