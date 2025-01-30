@extends('layouts.main')
@section('title', 'Procurements')
@section('content')
<div class="form-wrapper">
	<div class="row">
		<div class="col-md-6 col-sm-8 col-xs-6">
			<h3 class="box-title">Procurements</h3>	
		</div>
		<div class="col-md-6 col-sm-4 col-xs-6">
		    <div class="main-action-box">
                
                <a href="{{ route('procurements.create') }}" class="primary-btn">Add New</a>
		    </div>
	    </div>
    </div>
    @if($procurements->isEmpty())
        <br><div>No procurement found.</div><br>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width:16px">#</th>
                    <th style="width: 30%;;">Products</th>
                    <th>Ordered Units</th>
                    <th>Paid Amount</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($procurements as $procurement)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>
                    @foreach ($procurement->details as $detail)
                        <span class="custom-label">{{ $detail->product->name }} - ({{ $detail->quantity  }})</span>
                    @endforeach
                    </td>
                    <td>{{ $procurement->units_ordered }}</td>
                    <td>&pound; {{ $procurement->paid_amount }}</td>
                    <td>{{ $procurement->date }}</td>
                    <td>
                        <span class="pull-right">
                            <a href="{{ route('procurements.edit', $procurement->id) }}" class="primary-btn">Edit</a>
                            <form action="{{ route('procurements.destroy', $procurement->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="sm-danger-btn" onclick="return confirm('Are you sure you want to delete this procurement?')">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
