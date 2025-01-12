@extends('layouts.main')
@section('title', 'Procurements')

@section('content')
<h1>Procurements</h1>
<a href="{{ route('procurements.create') }}" class="btn btn-primary">Add Procurement</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Date</th>
            <th>Paid Amount</th>
            <th>Units Ordered</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($procurements as $procurement)
        <tr>
            <td>{{ $procurement->id }}</td>
            <td>{{ $procurement->product->name }}</td>
            <td>{{ $procurement->date }}</td>
            <td>${{ $procurement->paid_amount }}</td>
            <td>{{ $procurement->units_ordered }}</td>
            <td>
                <a href="{{ route('procurements.edit', $procurement->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('procurements.destroy', $procurement->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
