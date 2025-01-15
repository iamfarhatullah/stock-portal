
@if($stockRecords->isEmpty() && $products->isEmpty())
        <div class="alert alert-info text-center">No stock records and products found for the selected month.</div>
    @elseif($stockRecords->isEmpty())
        <div class="alert alert-info text-center">No stock records found for the selected month.</div>
    @else
        <table id="search-stock-table" class="table">
            <thead>
                <tr>
                    <th style="width:10px">#</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Landing Cost</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @php
                        $incomingRecords = $stockRecords->where('product_id', $product->id)->where('type', 'incoming');
                        $outgoingRecords = $stockRecords->where('product_id', $product->id)->where('type', 'outgoing');

                        $incomingQuantity = $incomingRecords->sum('quantity');
                        $outgoingQuantity = $outgoingRecords->sum('quantity');
                        $incomingPrice = $incomingRecords->first() ? $incomingRecords->first()->price : 0;
                        $outgoingPrice = $outgoingRecords->first() ? $outgoingRecords->first()->price : 0;

                        $incomingTotalPrice = $incomingQuantity * $incomingPrice;
                        $outgoingTotalPrice = $outgoingQuantity * $outgoingPrice;
                    @endphp
                    <tr>
                        <td rowspan="2" style="line-height: 50px;" >{{ $loop->iteration }}</td>
                        <td rowspan="2" style="line-height: 50px;" > <strong>{{ $product->name }}</strong> </td>
                        <td>Recieved from China</td>
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $incomingQuantity }}</td>
                        <td>$ {{ $incomingTotalPrice }}</td>
                        
                    </tr>
                    <tr>
                        <td>Sent to Amazon UK</td>
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $outgoingQuantity }}</td>
                        <td>$ {{ $outgoingTotalPrice }}</td>
                    </tr>
                    <tr style="background-color: #F8F8F8">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="pull-right"><strong>Available Stock</strong></span></td>
                        <td><strong>{{ $product->quantity }}</strong></td>
                        <td><strong>$ {{ $product->price * $product->quantity }}</strong></td>
                       
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif