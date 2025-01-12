@extends('layouts.main')
@section('title', 'Edit Warehouse Record')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Edit Warehouse Record</h3><br>
            <form action="{{ route('warehouse.update', $warehouse) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Description *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" class="form-field" value="{{ $warehouse->description }}" name="description" placeholder="Enter description">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Cost *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" step="0.01" class="form-field" value="{{ $warehouse->cost }}" name="cost" placeholder="Enter cost">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Units *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="number" class="form-field" value="{{ $warehouse->units }}" name="units" placeholder="Enter Units">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Date *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="date" class="form-field" value="{{ $warehouse->date }}" name="date">
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
