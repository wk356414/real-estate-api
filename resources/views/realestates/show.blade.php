@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Property Details</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $estate->name }}</h5>
            <p class="card-text">
                <strong>ID:</strong> {{ $estate->id }}<br>
                <strong>Type:</strong> {{ $estate->real_state_type }}<br>
                <strong>Street:</strong> {{ $estate->street }}<br>
                <strong>External Number:</strong> {{ $estate->external_number }}<br>
                <strong>Internal Number:</strong> {{ $estate->internal_number ?? 'N/A' }}<br>
                <strong>Neighborhood:</strong> {{ $estate->neighborhood }}<br>
                <strong>City:</strong> {{ $estate->city }}<br>
                <strong>Country:</strong> {{ $estate->country }}<br>
                <strong>Rooms:</strong> {{ $estate->rooms }}<br>
                <strong>Bathrooms:</strong> {{ $estate->bathrooms }}<br>
                <strong>Comments:</strong> {{ $estate->comments }}
            </p>
            <div class="mt-3">
                <a href="{{ route('realestates.index') }}" class="btn btn-secondary">Back to List</a>
                @if($estate->trashed())
                    <form action="{{ route('realestates.restore', $estate->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                    <form action="{{ route('realestates.hardDelete', $estate->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete this property?');">
                            Hard Delete
                        </button>
                    </form>
                @else
                    <a href="{{ route('realestates.edit', $estate->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('realestates.destroy', $estate->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this property?');">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
