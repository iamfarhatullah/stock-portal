@extends('layouts.main')
@section('title', 'Stock Records')
@section('content')
<div class="form-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title">Stock Records
                <span class="pull-right">
                    <!-- <a href="{{ route('reports.stock_report') }}" target="_blank" class="primary-btn"><i class="fas fa-print"></i></a> -->
                </span>
            </h3>
        </div>
    </div>
    <!-- <form method="GET" action="{{ route('stocks.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="month">Select Month:</label>
                <input type="month" name="month" id="month" class="form-field" value="{{ request('month', \Carbon\Carbon::now()->format('Y-m')) }}">
            </div>
            <div class="col-md-4 align-self-end" style="padding-top: 30px;">
                <button type="submit" class="primary-btn">Filter</button>
            </div>
        </div>
    </form> -->
    @if($stockRecords->isEmpty() && $products->isEmpty())
        <br><div>No stock record & products found.</div><br>
    @elseif($stockRecords->isEmpty())
        <br><div>No stock record found.</div><br>
    @else
    <div class="row">
		<div class="col-md-4">
			<input type="text" id="searchInput" onkeyup="searchStockTable()" class="form-field" placeholder="Search. . .">
		</div>
	</div>
    <table id="search-stock-table" class="table">
        <thead>
            <tr>
                <th style="width:5px">#</th>
                <th>Product</th>
                <th>Type</th>
                <th>Landing Cost</th>
                <th>Quantity</th>
                <th>Total Cost</th>
                <th style="width:150px">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            @php
                $incomingRecords = $stockRecords->where('product_id', $product->id)->where('type', 'incoming');
                $outgoingRecords = $stockRecords->where('product_id', $product->id)->where('type', 'outgoing');

                $incomingQuantity = $incomingRecords->sum('quantity');
                $outgoingQuantity = $outgoingRecords->sum('quantity');
                $incomingPrice = $incomingRecords->first() ? $incomingRecords->first()->price : 0;
                $outgoingPrice = $outgoingRecords->first() ? $outgoingRecords->first()->price : 0;

                $incomingTotalPrice = $incomingQuantity * $incomingPrice;
                $outgoingTotalPrice = $outgoingQuantity * $outgoingPrice;
            @endphp
            <tr>
                <td rowspan="2" style="line-height: 50px;" >{{ $loop->iteration }}</td>
                <td rowspan="2" style="line-height: 50px;" > <strong>{{ $product->name }}</strong> </td> <!-- Span for incoming and outgoing rows -->
                <td>Recieved from China</td>
                <td>$ {{ $product->price }}</td>
                <td>{{ $incomingQuantity }}</td>
                <td>$ {{ $incomingTotalPrice }}</td>
                <td rowspan="2" style="line-height: 54px;">
                    <div class="pull-right">
                        <a href="{{ route('stocks.product-stock', $product->id) }}" class="primary-btn">Manage Stock</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Sent to Amazon UK</td>
                <td>$ {{ $product->price }}</td>
                <td>{{ $outgoingQuantity }}</td>
                <td>$ {{ $outgoingTotalPrice }}</td>
            </tr>
            <tr style="background-color: #F8F8F8">
                <td></td>
                <td></td>
                <td></td>
                <td><span class="pull-right"><strong>Available Stock</strong></span></td>
                <td><strong>{{ $product->quantity }}</strong></td>
                <td><strong>$ {{ $product->price * $product->quantity }}</strong></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
