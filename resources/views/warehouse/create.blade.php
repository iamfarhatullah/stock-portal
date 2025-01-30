@extends('layouts.main')
@section('title', 'Add Warehouse Record')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add Warehouse Record</h3><br>
            <form action="{{ route('warehouse.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="description">Description *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <textarea id="description" class="textarea-field" name="description" rows="5" placeholder="Enter description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="cost">Shipment Cost *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" id="cost" class="form-field" value="{{ old('cost') }}" name="cost" placeholder="Enter cost">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="date">Date *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="date" id="date" class="form-field" name="date" value="{{ old('date', now()->toDateString()) }}" placeholder="Select Date">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Select Products *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <div id="product-selection">
                            @if($products->isEmpty())
                                <span class="text-danger">No products found <br> Please add products first.</span>
                            @else
                                @foreach ($products as $product)
                                <div class="product-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="product_{{ $product->id }}">
                                                <input type="checkbox" id="product_{{ $product->id }}" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox" {{ old('product_ids') && in_array($product->id, old('product_ids', [])) ? 'checked' : '' }}>
                                                {{ $product->name }}
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" 
                                                   name="quantities[{{ $product->id }}]" 
                                                   class="form-field product-quantity {{ old('product_ids') && in_array($product->id, old('product_ids', [])) ? '' : 'hidden' }}" 
                                                   value="{{ old('quantities.' . $product->id) }}" 
                                                   placeholder="Enter quantity">
                                            @error('quantities.' . $product->id)
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
                        <div class="pull-right">
                            <button type="submit" class="success-btn">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                const quantityInput = event.target.closest('.product-item').querySelector('.product-quantity');
                if (event.target.checked) {
                    quantityInput.classList.remove('hidden');
                } else {
                    quantityInput.classList.add('hidden');
                    quantityInput.value = ''; 
                }
            });
        });
    });
</script>
<style>
    .hidden {
        display: none;
    }
    .text-danger {
        color: red;
    }
</style>
@endsection
