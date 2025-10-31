@extends('layouts.navbar-admin')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">
        Work <span class="text-red-600">Accident</span> Information
    </h1>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.accident.filter') }}" class="mb-4 d-flex gap-2">
        <select name="status" class="form-select w-auto">
            <option value="">Semua Status</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
        </select>

        <select name="category" class="form-select w-auto">
            <option value="">Semua Category</option>
            <option value="work accident" {{ request('category') == 'work accident' ? 'selected' : '' }}>Work Accident</option>
            <option value="traffic accident" {{ request('category') == 'traffic accident' ? 'selected' : '' }}>Traffic Accident</option>
            <option value="non-work accident" {{ request('category') == 'non-work accident' ? 'selected' : '' }}>Non Work Accident</option>
          
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.accident.filter') }}" class="btn btn-secondary">Reset</a>
    </form>

    {{-- Statistic Cards --}}
    @php 
        $statsCard = [
            'Total Accidents' => $totalAccidents,
            'Total Work Accidents' => $totalWorkAccidents,
            'Total Traffic Accidents' => $totalTrafficAccidents,
            'Total Non Work Accidents' => $totalNonWorkAccidents,
];

        $statsCard2 = [
            'Total Investigation' => $totalInvestigation,
            'Total Closed Accidents' => $totalClosedAccidents,
            'Total Opened Accidents' => $totalOpenedAccidents,
        ];
    @endphp

    <div class="space-y-4 mt-4 mb-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($statsCard as $label => $value)
            <div class="bg-white shadow rounded-xl p-4 text-center">
                <h6>{{ $label }}</h6>
                <h3>{{ $value }}</h3>
            </div>
            @endforeach
        </div>
   <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach($statsCard2 as $label => $value)
        <div class="bg-white shadow rounded-xl p-4 text-center">
            <h6>{{ $label }}</h6>
            <h3>{{ $value }}</h3>
        </div>
    @endforeach
</div>
    </div>


    {{-- Work Accident Section --}}
    <h2 class="text-2xl font-bold mt-6 mb-4">Work Accident</h2>

    @foreach ($workAccidents as $type => $items)
        <h3 class="text-lg font-semibold mt-6 mb-2">{{ $type }}</h3>
        <h2 class="text-sm font-semibold mb-2">{{ count($items ?? [])  }} Cases</h2>

        <table class="w-full border mb-6 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Category</th>
                    <th class="border px-4 py-2">Type</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Date of incident</th>
                     <th class="border px-4 py-2">Created at</th>
                    <th class="border px-4 py-2">Action</th>
                     <th class="border px-4 py-2">Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                     <td class="border px-4 py-2">{{ $item->category }}</td>
                    <td class="border px-4 py-2">{{ $item->type }}</td>
                      <td class="border px-4 py-2">
                        <span class="status-btn" data-id="{{ $item->id }}" style="cursor:pointer; color:blue;">
                            {{ $item->status ?? '-' }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-500 hover:underline">Detail</a>
                        <a href="{{ route('investigations.index', $item->id) }}" class="btn btn-sm btn-warning">Investigate</a>
                        <a href="{{ route('admin.accident.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                    </td>
                    <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    {{-- Traffic Accident --}}
    <h3 class="text-2xl font-bold mt-6 mb-4">Traffic Accident</h3>
   @if(!empty($trafficAccidents) && count($trafficAccidents) > 0)
   <h3 class="text-lg font-semibold mt-6 mb-2">{{ count($trafficAccidents) }} Cases</h3>
    <table class="w-full border mb-4 text-sm">
        <thead class="bg-gray-100">
            
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Category</th>
                 <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Date of incident</th>
                 <th class="border px-4 py-2">Created at</th>
                <th class="border px-4 py-2">Action</th>
                 <th class="border px-4 py-2">Updated at</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($trafficAccidents as $item)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
             <td class="border px-4 py-2">{{ $item->category }}</td>
               <td class="border px-4 py-2">
                    <span class="status-btn" data-id="{{ $item->id }}" style="cursor:pointer; color:blue;">{{ $item->status ?? '-' }}</span>
                </td>
                <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                <td class="border px-4 py-2">
                   <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-500 hover:underline">Detail</a>
                    <a href="{{ route('investigations.index', $item->id) }}" class="btn btn-sm btn-warning">Investigate</a>
                    <a href="{{ route('admin.accident.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                </td>
                <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- Non Work Accident --}}
    <h3 class="text-2xl font-bold mt-6 mb-4">Non Work Accident</h3>
      @foreach ($nonWorkAccidents as $type => $items)
            <h3 class="text-lg font-semibold mt-6 mb-2">{{ $type }}</h3>
        <h2 class="text-sm font-semibold mb-2">{{ count($items) }} Cases</h2>
    <table class="w-full border mb-4 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
               
                 <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Type</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Date of incident</th>
                 <th class="border px-4 py-2">Created at</th>
                <th class="border px-4 py-2">Action</th>
                <th class="border px-4 py-2">Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item )
                
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                  <td class="border px-4 py-2">{{ $item->category }}</td>
                <td class="border px-4 py-2">{{ $item->type }}</td>
                 <td class="border px-4 py-2">
                    <span class="status-btn" data-id="{{ $item->id }}" style="cursor:pointer; color:blue;">{{ $item->status ?? '-' }}</span>
                </td>
                <td class="border px-4 py-2">{{ $item->date->format('d-m-Y') }}</td>
                <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                <td class="border px-4 py-2">
                   <a href="{{ route('admin.accident.show', $item->id) }}" class="text-blue-500 hover:underline">Detail</a>
                    <a href="{{ route('investigations.index', $item->id) }}" class="btn btn-sm btn-warning">Investigate</a>
                    <a href="{{ route('admin.accident.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                </td>
                <td class="border px-4 py-2">{{ $item->updated_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
      @endforeach
</div>

{{-- JS Toggle Status --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.status-btn').forEach(el => {
        el.addEventListener('click', function() {
            const id = this.dataset.id;
            const currentStatus = this.textContent.trim().toLowerCase();

            // hanya izinkan klik kalau status open
            if (currentStatus !== 'open') return;

            const newStatus = 'close';
            this.textContent = newStatus;

            fetch(`/update-status/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.style.color = 'gray';
                    this.style.cursor = 'not-allowed';
                    this.style.pointerEvents = 'none';
                } else {
                    alert('Gagal update status!');
                    this.textContent = currentStatus;
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan!');
                this.textContent = currentStatus;
            });
        });
    });
});
</script>

@endsection
