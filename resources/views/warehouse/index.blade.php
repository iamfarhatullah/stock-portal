@extends('layouts.main')
@section('title', 'Warehouse')
@section('content')
<div class="form-wrapper">
	<div class="row">
		<div class="col-md-6 col-sm-8 col-xs-6">
			<h3 class="box-title">Warehouse Records</h3>	
		</div>
		<div class="col-md-6 col-sm-4 col-xs-6">
		    <div class="main-action-box">
                <a href="{{ route('warehouse.create') }}" class="primary-btn">Add New</a>
			</div>
		</div>
    </div>
    @if ($warehouses->isEmpty())
        <p>No records found.</p>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Units</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $warehouse->description }}</td>
                        <td>${{ $warehouse->cost }}</td>
                        <td>{{ $warehouse->units }}</td>
                        <td>{{ $warehouse->date }}</td>
                        <td>
                            <a href="{{ route('warehouse.edit', $warehouse) }}" class="primary-btn">Edit</a>
                            <form action="{{ route('warehouse.destroy', $warehouse) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sm-danger-btn" onclick="return confirm('Are you sure you want to delete this record?')"> 
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                            <!-- <form action="{{ route('warehouse.destroy', $warehouse) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
