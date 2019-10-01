@extends('layouts.app')

@section('page_title')

    Dashboard
    
@endsection

@section('content')

<div class="dashboard">

    <div class="container-fluid">

        <div class="container main-content-container">

            <div class="row">

                <div class="col-md-2 sidebar">

                    <div class="sidebar-inner">

                        <div class="add-events">

                            <h3>Update Data</h3>

                            <div class="event-to-add">

                                <div class="event-name">

                                    <p>Add your latest event data here!</p>

                                </div>

                                <a href="{{ route('dealershipEvents',$dealership->id) }}" class="btn">Add Data</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-10 main-content">

                    <div class="row cardc">

                        <div class="col-md-4 donut-1">

                            <div class="donut1-content">

                                <h3>Response Rate</h3>

                                @if($dealership->data_count > 0)

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $dealership->data_count }} Invites</p>

                                    <p>{{ $dealership->appointments }} Appointments</p>
                                    
                                    <p>{{ number_format($dealership->appointments/$dealership->data_count * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4 donut-2">

                            <div class="donut2-content">

                                <h3>Conversion Rate</h3>

                                @if($dealership->appointments > 0)

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $dealership->appointments }} appointments</p>

                                    <p>{{ $dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km }} Sales</p>

                                    <p>{{ number_format(($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km)/$dealership->appointments * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4">

                            <h3>Sales breakdown</h3>

                            @if($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress > 0)

                                <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                
                                <div class="camembert-slice-container">

                                    @if(number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-1"></div>
                                            {{ number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% New
                                        </div>
                                    @endif

                                    @if(number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-2"></div>
                                            {{ number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% Used
                                        </div>
                                    @endif

                                    @if(number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-3"></div>
                                            {{ number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% Demo
                                        </div>
                                    @endif

                                    @if(number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-4"></div>
                                            {{ number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% 0KM
                                        </div>
                                    @endif

                                    @if(number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice final">
                                            <div class="circle circle-5"></div>
                                            {{ number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% In progress
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
                {{ $dealership->appointments }}, 
                {{ $dealership->data_count - $dealership->appointments }}
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
                {{ $dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km }}, 
                {{ $dealership->appointments - $dealership->new - $dealership->used - $dealership->demo - $dealership->zero_km }}
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
                @if($dealership->new > 0)"#304651",@endif 
                @if($dealership->used > 0)"#262E33",@endif 
                @if($dealership->demo > 0)"#CDDEEA",@endif 
                @if($dealership->zero_km > 0)"#667681",@endif 
                @if($dealership->inprogress > 0)"#8A9FAD"@endif 
            ],
            data: [
                @if($dealership->new > 0){{ $dealership->new }},@endif 
                @if($dealership->used > 0){{ $dealership->used }},@endif 
                @if($dealership->demo > 0){{ $dealership->demo }},@endif 
                @if($dealership->zero_km > 0){{ $dealership->zero_km }},@endif 
                @if($dealership->inprogress > 0){{ $dealership->inprogress }}@endif
            ]
        }],
        labels: [
            @if($dealership->new > 0)"New",@endif 
            @if($dealership->used > 0)"Used",@endif 
            @if($dealership->demo > 0)"Demo",@endif 
            @if($dealership->zero_km > 0)"0km",@endif 
            @if($dealership->inprogress > 0)"In Progress"@endif 
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