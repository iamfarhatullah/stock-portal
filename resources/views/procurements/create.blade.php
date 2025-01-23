@extends('layouts.main')
@section('title', 'Add Procurement')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add Procurement</h3><br>
            <form action="{{ route('procurements.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="date">Date *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="date" class="form-field" id="date" value="{{ old('date') }}" name="date">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label for="paid_amount">Paid Amount *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" id="paid_amount" value="{{ old('paid_amount') }}" step="0.01" name="paid_amount" placeholder="Enter paid amount">
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

<script>
    // JavaScript to toggle quantity input based on checkbox selection
    document.addEventListener('DOMContentLoaded', () => {
        const productCheckboxes = document.querySelectorAll('.product-checkbox');

        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                const quantityInput = event.target.closest('.product-item').querySelector('.product-quantity');
                if (event.target.checked) {
                    quantityInput.classList.remove('hidden');
                } else {
                    quantityInput.classList.add('hidden');
                    quantityInput.value = ''; // Clear the value if the checkbox is unchecked
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
