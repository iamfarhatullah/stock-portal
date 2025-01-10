@extends('layouts.main')
@section('title', 'Edit Product')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Edit product</h3><br>
            <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Product Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" class="form-field" value="{{ $product->name }}" name="name" placeholder="Enter product name">
                    </div>
                </div>
                <br>
                <!-- <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Quantity *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" value="{{ $product->quantity }}" name="quantity" placeholder="Enter product quantity">
                    </div>
                </div>
                <br> -->
                <input type="hidden" class="form-field" value="0" name="quantity" placeholder="Enter product quantity">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Landing Price *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" class="form-control" value="{{ $product->price }}" name="price" placeholder="Enter landing price">
                    </div>
                </div>
                                
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
						<div class="pull-right">
							<!-- <input type="reset" class="primary-btn" value="Reset"> -->
							<button type="submit" class="success-btn">Update Product</button><br><br>
						</div>
						
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
@endsection
