@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Real Estate Properties</h1>
    <a href="{{ route('realestates.create') }}" class="btn btn-primary mb-3">Add New Property</a>
    <div class="table-responsive">
        <table id="realEstateTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($realEstates as $estate)
                <tr @if($estate->trashed()) class="table-warning" @endif>
                    <td>{{ $estate->id }}</td>
                    <td>{{ $estate->name }}</td>
                    <td>{{ $estate->real_state_type }}</td>
                    <td>{{ $estate->city }}</td>
                    <td>{{ $estate->country }}</td>
                    <td>
                        @if($estate->trashed())
                            <form action="{{ route('realestates.restore', $estate->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Restore this property?');">
                                    Restore
                                </button>
                            </form>
                            <form action="{{ route('realestates.hardDelete', $estate->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this property?');">
                                    Hard Delete
                                </button>
                            </form>
                        @else
                            <a href="{{ route('realestates.show', $estate->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('realestates.edit', $estate->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('realestates.destroy', $estate->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this property?');">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 4 JS (optional, for styling) -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#realEstateTable').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true
        });
    });
</script>
@endsection