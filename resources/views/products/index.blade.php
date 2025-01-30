@extends('layouts.main')
@section('title', 'Products')
@section('content')
<div class="form-wrapper">
	<div class="row">
		<div class="col-md-6 col-sm-8 col-xs-6">
			<h3 class="box-title">Product List</h3>	
		</div>
		<div class="col-md-6 col-sm-4 col-xs-6">
			<div class="main-action-box">
                <a href="{{ route('products.create') }}" class="primary-btn">Add New</a>
			</div>
		</div>
    </div>
    @if($products->isEmpty())
        <br><div>No record found.</div><br>
    @else
    <div class="table-responsive">
        <table id="search-table" class="table table-striped table-hover">
            <thead>
                <tr>
                <th style="width:16px">#</th>
                <th style="width: 20%">Name</th>
                <th>Quantity</th>
                <th>Landing Cost</th>
                <th style=""></th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalQuantity = 0;
                $grandTotal = 0;    
            @endphp
                @foreach ($products as $product)
                @php
                    $totalQuantity += $product->quantity;
                    $grandTotal += $product->price * $product->quantity;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>&pound; {{ $product->price }}</td>
                    <td>
                        <div class="pull-right">
                            <span style="padding-right: 4px;"></span>
                            
                            <a href="{{ route('products.edit', $product) }}" class="primary-btn">Edit</a>
                        
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sm-danger-btn" onclick="return confirm('Are you sure you want to delete this product?')"> 
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
