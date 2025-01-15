@extends('layouts.main')
@section('title', 'Edit Stock Record')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Edit Stock Record</h3><br>
            <form action="{{ route('stocks.stock_records.update', $stockRecord->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Product *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                    <select class="form-field" name="product_id" readonly>
                        <option value="">Select a product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $stockRecord->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                        @endforeach
                    </select>
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
                            <option value="incoming" {{ $stockRecord->type == 'incoming' ? 'selected' : '' }}>Recieved from China</option>
                            <option value="outgoing" {{ $stockRecord->type == 'outgoing' ? 'selected' : '' }}>Sent to Amazon UK</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Quantity *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" value="{{ $stockRecord->quantity }}" name="quantity" class="form-field" placeholder="Enter quantity">
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
