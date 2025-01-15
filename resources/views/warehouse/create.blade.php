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
                        <label>Description *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <textarea class="textarea-field" name="description" rows="5" placeholder="Enter description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Cost *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" class="form-field" value="{{ old('cost') }}" name="cost" placeholder="Enter cost">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Units *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" value="{{ old('units') }}" name="units" placeholder="Enter Units">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Date *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="date" class="form-field" name="date">
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
