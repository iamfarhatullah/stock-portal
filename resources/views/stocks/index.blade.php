@extends('layouts.main')
@section('title', 'Stock Records')
@section('content')
<div class="form-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title">Stock Records
                <span class="pull-right">
                    <!-- <a href="{{ route('reports.stock_report') }}" target="_blank" class="primary-btn"><i class="fas fa-print"></i></a> -->
                    <a href="{{ route('stocks.stock_records.index') }}" class="primary-btn">Manage Stock</a>
                </span>
            </h3>
        </div>
    </div>
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
    <div class="table-responsive">
        <table id="search-stock-table" class="table">
            <thead>
                <tr>
                    <th style="width:16px">#</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Landing Cost</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
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
                    <td>&pound; {{ $product->price }}</td>
                    <td>{{ $incomingQuantity }}</td>
                    <td>&pound; {{ $incomingTotalPrice }}</td>
                </tr>
                <tr>
                    <td>Sent to Amazon UK</td>
                    <td>&pound; {{ $product->price }}</td>
                    <td>{{ $outgoingQuantity }}</td>
                    <td>&pound; {{ $outgoingTotalPrice }}</td>
                </tr>
                <tr style="background-color: #F8F8F8">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span class="pull-right"><strong>Available Stock</strong></span></td>
                    <td><strong>{{ $product->quantity }}</strong></td>
                    <td><strong>&pound; {{ $product->price * $product->quantity }}</strong></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
