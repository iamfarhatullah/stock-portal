@extends('layouts.main')
@section('title', 'Manage Stock')
@section('content')

<div class="form-wrapper">
			<div class="row">
				<div class="col-md-6 col-sm-8 col-xs-6">
					<h3 class="box-title">Manage Stock for <strong> {{ $product->name }} </strong></h3>	
				</div>
				<div class="col-md-6 col-sm-4 col-xs-6">
				    <div class="main-action-box">
                        <a href="{{ route('stocks.create', $product->id) }}" class="primary-btn">Add Stock Record</a>
				    </div>
			    </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            @if($stockRecords->isEmpty())
                <div class="alert alert-info text-center">No Record found.</div>
            @else
            <table id="search-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stockRecords as $record)
                    <tr>
                        <td>{{ $record->type == 'incoming' ? "Recieved from China" : "Sent to Amazon UK" }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>${{ $record->price }}</td>
                        <td>{{ $record->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
	</div>
@endsection