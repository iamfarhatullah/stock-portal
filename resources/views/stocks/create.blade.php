@extends('layouts.main')
@section('title', 'Add Stock')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add Stock Movement for <strong>{{ $product->name }}</strong></h3><br>
            <form action="{{ route('stocks.store', $product->id) }}" method="POST">
            @csrf
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
                        <input type="number" class="form-field" name="quantity" placeholder="Enter product quantity">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="price">Unit Price</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" class="form-field" value="{{$product->price}}" name="price" placeholder="Enter landing price">
                    </div>
                </div>
                                
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
						<div class="pull-right">
							<!-- <input type="reset" class="primary-btn" value="Reset"> -->
							<button type="submit" class="success-btn">Save</button><br><br>
						</div>
						
					</div>
				</div>
            </form>
        </div>
    </div>
</div>


 @endsection
