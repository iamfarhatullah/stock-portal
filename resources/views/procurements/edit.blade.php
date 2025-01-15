@extends('layouts.main')
@section('title', 'Edit Procurement')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Edit Procurement</h3><br>
            <form action="{{ route('procurements.update', $procurement->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Date *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                    <input type="date" name="date" class="form-field" value="{{ old('date', $procurement->date) }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Paid Amount *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" value="{{ old('paid_amount', $procurement->paid_amount) }}" step="0.01" name="paid_amount" placeholder="Enter paid amount">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Units Ordered *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" value="{{ old('units_ordered', $procurement->units_ordered) }}" name="units_ordered" placeholder="Enter ordered units">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Select Products *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                    <div>
                        @foreach ($products as $product)
                            <label class="col-md-4 col-sm-4">
                                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}"
                                {{ in_array($product->id, $procurement->details->pluck('product_id')->toArray()) ? 'checked' : '' }}>
                                {{ $product->name }}
                            </label>
                        @endforeach
                    </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
                        <div class="pull-right">
                            <button type="submit" class="success-btn">Update</button><br><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
