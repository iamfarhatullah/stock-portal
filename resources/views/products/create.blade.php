@extends('layouts.main')
@section('title', 'Add new Product')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add new product</h3><br>
            <form action="{{ route('products.store') }}" method="POST">
            @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Product Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" class="form-field" value="{{ old('name') }}" name="name" placeholder="Enter product name">
                    </div>
                </div>
                <br>
                <input type="hidden" class="form-field" value="0" name="quantity" placeholder="Enter product quantity">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Landing Price *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" class="form-control" value="{{ old('price') }}" name="price" placeholder="Enter landing price">
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
