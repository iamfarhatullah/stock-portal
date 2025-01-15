@extends('layouts.main')
@section('title', 'Add Stock Record')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Create Stock Record</h3><br>
            <form action="{{ route('stocks.stock_records.store') }}" method="POST">
            @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Product *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                    @if($products->isEmpty())
                        <span class="text-danger">No products found <br> Please add products first.</span>
                    @else
                    <select class="form-field" name="product_id">
                    <option value="">Select a product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                    </select>
                    @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Stock Movement Type *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <select class="form-field" id="type" name="type">
                            <option value="">Select Type</option>
                            <option value="incoming">Recieved from China</option>
                            <option value="outgoing">Sent to Amazon UK</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Quantity *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" name="quantity" class="form-field" placeholder="Enter quantity">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
						<div class="pull-right">
							<button type="submit" class="success-btn">Save</button><br><br>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
@endsection
