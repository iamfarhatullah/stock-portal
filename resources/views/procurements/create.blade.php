@extends('layouts.main')
@section('title', 'Add Procurement')

@section('content')
<h1>Add Procurement</h1>
<form action="{{ route('procurements.store') }}" method="POST">
    @csrf
    <div>
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id">
            @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date">
    </div>
    <div>
        <label for="paid_amount">Paid Amount:</label>
        <input type="number" name="paid_amount" id="paid_amount" step="0.01">
    </div>
    <div>
        <label for="units_ordered">Units Ordered:</label>
        <input type="number" name="units_ordered" id="units_ordered">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
