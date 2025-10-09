@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Accident Investigations</h1>
</div>

<table class="table mt-3">
    <thead>
        <tr>
            <th>accident</th>
            <th>investigator</th>
            <th>root_cause</th>
            <th>corrective_action</th>
            <th>status</th>
        </tr>
    </thead>a
    <tbody>
        @foreach ($investigation as $i)
        <tr>
            <td>{{ $i->accidents->id ?? '-' }}</td>
            <td>{{ $i->investigator }}</td>
            <td>{{ $i->root_cause }}</td>
            <td>{{ $i->corrective_action }}</td>
            <td>{{ $i->status }}</td>
            <td>
                <a href="{{ route('investigations.edit', $i) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('investigations.destroy', $i) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </td>
            </td>
        </tr>
            
        @endforeach
    </tbody>
</table>


  {{ $investigation->links() }}
</div>
@endsection
