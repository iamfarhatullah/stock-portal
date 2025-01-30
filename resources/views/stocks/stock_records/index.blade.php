@extends('layouts.main')
@section('title', 'Stock Records')
@section('content')

<div class="form-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title">Stock Records
                <span class="pull-right">
                    <a href="{{ route('stocks.stock_records.create') }}" class="primary-btn">Create New</a>
                </span>
            </h3>
        </div>
    </div>
    @if($stockRecords->isEmpty())
        <br><div>No stock record found.</div><br>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width:16px">#</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockRecords as $record)
                    @php
                        $movement_type = '';
                        $record->type == 'incoming' ? $movement_type = 'Recieved from China' : $movement_type = 'Sent to Amazon UK';
                    @endphp
                    
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $record->product->name }}</td>
                        <td>{{ $movement_type }} </td>
                        <td>&pound; {{ $record->price }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>
                            <span class="pull-right">
                                <a href="{{ route('stocks.stock_records.edit', $record->id) }}" class="primary-btn">Edit</a>
                                <form action="{{ route('stocks.stock_records.destroy', $record->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sm-danger-btn" onclick="return confirm('Are you sure you want to delete this record?')">
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