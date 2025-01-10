@extends('layouts.main')
@section('title', 'Sales')
@section('content')
<div class="container">
    <h1>Sales Records</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Unit Name</th>
                <th>Units Sold</th>
                <th>Cost (Per Unit)</th>
                <th>Total Cost</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @php
            $grandTotal = 0;
            $qtyTotal = 0;
        @endphp
            @forelse($sales as $sale)
            @php
                $grandTotal += $sale->total;
                $qtyTotal += $sale->quantity;
            @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->price }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No sales records found.</td>
                </tr>
            @endforelse
            @if($sales->isNotEmpty())
                <tr>
                    <td colspan="2" class="text-end"></td>
                    <td class="text-end"><strong>{{ $qtyTotal }}</strong></td>
                    <td></td>
                    <td><strong>{{ $grandTotal }}</strong></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('sales.create') }}" class="btn btn-primary">Record New Sale</a>
</div>
@endsection
