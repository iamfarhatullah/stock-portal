
@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <x-info-tile title="Total Products" icon="fas fa-cube" count="{{$totalProducts}}"/>
    <x-info-tile title="Low Stock Product" icon="fas fa-cube" count="{{$lowQuantityProducts}}"/>
    <x-info-tile title="Zero Stock Product" icon="fas fa-cube" count="{{$zeroQuantityProducts}}"/>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-wrapper">
			<div class="row">
				<div class="col-md-12">
					<h3 class="box-title">Available Stock</h3>	
				</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="width: 98%; margin: auto; text-align: center;">
                        <canvas id="pieChart"></canvas>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const products = @json($products);
    const labels = products.map(product => product.name); 
    const data = products.map(product => product.quantity);
    const ctx = document.getElementById('pieChart').getContext('2d');
    const backgroundColors = [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(100, 200, 255, 0.6)',
        'rgba(200, 100, 150, 0.6)'
    ];
    const borderColors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(100, 200, 255, 1)',
        'rgba(200, 100, 150, 1)'
    ];
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Qty',
                data: data, 
                backgroundColor: backgroundColors.slice(0, data.length),
                borderColor: borderColors.slice(0, data.length), 
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'none',
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    color: '#000',
                    formatter: function(value) {
                        return value;
                    }
                }
            }
        }
    });
</script>

@endsection