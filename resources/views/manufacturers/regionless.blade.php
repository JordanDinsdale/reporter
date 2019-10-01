@extends('layouts.app')

@section('page_title')

    Dashboard
    
@endsection

@section('content')

<div class="dashboard">

    <div class="container-fluid">

        <div class="container main-content-container">

            <div class="row">

                <div class="col-md-12 main-content">

                    <div class="row cardc">

                        <div class="col-md-4 donut-1">

                            <div class="donut1-content">

                                <h3>Response Rate</h3>

                                @if($manufacturer->region_data_count > 0)

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $manufacturer->region_data_count }} Invites</p>
                                    <p>{{ $manufacturer->region_appointments }} Appointments</p>
                                    <p>{{ number_format($manufacturer->region_appointments/$manufacturer->region_data_count * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4 donut-2">

                            <div class="donut2-content">

                                <h3>Conversion Rate</h3>

                                @if($manufacturer->region_appointments > 0)

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $manufacturer->region_appointments }} appointments</p>
                                    <p>{{ $manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km }} Sales</p>
                                    <p>{{ number_format(($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km)/$manufacturer->region_appointments * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4">

                            <h3>Sales breakdown</h3>

                            @if($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress > 0)

                                <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                
                                <div class="camembert-slice-container">

                                    @if(number_format($manufacturer->region_new/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-1"></div>
                                            {{ number_format($manufacturer->region_new/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}% New
                                        </div>
                                    @endif

                                    @if(number_format($manufacturer->region_used/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-2"></div>
                                            {{ number_format($manufacturer->region_used/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}% Used
                                        </div>
                                    @endif

                                    @if(number_format($manufacturer->region_demo/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-3"></div>
                                            {{ number_format($manufacturer->region_demo/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}% Demo
                                        </div>
                                    @endif

                                    @if(number_format($manufacturer->region_zero_km/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-4"></div>
                                            {{ number_format($manufacturer->region_zero_km/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}% 0KM
                                        </div>
                                    @endif

                                    @if(number_format($manufacturer->region_inprogress/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice final">
                                            <div class="circle circle-5"></div>
                                            {{ number_format($manufacturer->region_inprogress/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}% In progress
                                        </div>
                                    @endif

                                </div>

                            @else

                                <p>No information to display</p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">

var ctx = document.getElementById('responseRate').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        datasets: [{
            borderWidth: '0',
            backgroundColor: [
                "#8A9FAD",
                "#333C42"
            ],
            data: [
                {{ $manufacturer->region_appointments }}, 
                {{ $manufacturer->region_data_count - $manufacturer->region_appointments }}
            ]
        }],
        labels: [
            "Appointments",
            "No Appointment Made"
        ]
    },

    // Configuration options go here
    options: {
        legend: {
            display: false,
        },
        cutoutPercentage: 90
    }
});

</script>


<script type="text/javascript">
var ctx = document.getElementById('conversionRate').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        datasets: [{
            borderWidth: '0',
            backgroundColor: [
                "#8A9FAD",
                "#333C42"
            ],
            data: [
                {{ $manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress }}, 
                {{ $manufacturer->region_appointments - $manufacturer->region_new - $manufacturer->region_used - $manufacturer->region_demo - $manufacturer->region_zero_km - $manufacturer->region_inprogress }}
            ]
        }],
        labels: [
            "Sales",
            "No Sale Made"
        ]
    },

    // Configuration options go here
    options: {
        legend: {
            display: false,
        },
        cutoutPercentage: 90
    }
});

</script>


<script type="text/javascript">

var ctx = document.getElementById('salesBreakdown').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        datasets: [{
            borderWidth: '0',
            backgroundColor: [
                @if($manufacturer->region_new > 0)"#304651",@endif 
                @if($manufacturer->region_used > 0)"#262E33",@endif 
                @if($manufacturer->region_demo > 0)"#CDDEEA",@endif 
                @if($manufacturer->region_zero_km > 0)"#667681",@endif 
                @if($manufacturer->region_inprogress > 0)"#8A9FAD"@endif 
            ],
            data: [
                @if($manufacturer->region_new > 0){{ $manufacturer->region_new }},@endif 
                @if($manufacturer->region_used > 0){{ $manufacturer->region_used }},@endif 
                @if($manufacturer->region_demo > 0){{ $manufacturer->region_demo }},@endif 
                @if($manufacturer->region_zero_km > 0){{ $manufacturer->region_zero_km }},@endif 
                @if($manufacturer->region_inprogress > 0){{ $manufacturer->region_inprogress }}@endif
            ]
        }],
        labels: [
            @if($manufacturer->region_new > 0)"New",@endif 
            @if($manufacturer->region_used > 0)"Used",@endif 
            @if($manufacturer->region_demo > 0)"Demo",@endif 
            @if($manufacturer->region_zero_km > 0)"0km",@endif 
            @if($manufacturer->region_inprogress > 0)"In Progress"@endif 
        ]
    },

    // Configuration options go here
    options: {
        legend: {
            display: false,
        },
        cutoutPercentage: 50
    }
});

</script>

@endsection