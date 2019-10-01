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

                                @if($region->data_count > 0)

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $region->data_count }} Invites</p>
                                    <p>{{ $region->appointments }} Appointments</p>
                                    <p>{{ number_format($region->appointments/$region->data_count * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4 donut-2">

                            <div class="donut2-content">

                                <h3>Conversion Rate</h3>

                                @if($region->appointments > 0)

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $region->appointments }} appointments</p>
                                    <p>{{ $region->new + $region->used + $region->demo + $region->zero_km }} Sales</p>
                                    <p>{{ number_format(($region->new + $region->used + $region->demo + $region->zero_km)/$region->appointments * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>No information to display</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4">

                            <h3>Sales breakdown</h3>

                            @if($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress > 0)

                                <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                
                                <div class="camembert-slice-container">

                                    @if(number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-1"></div>
                                            {{ number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}% New
                                        </div>
                                    @endif

                                    @if(number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-2"></div>
                                            {{ number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}% Used
                                        </div>
                                    @endif

                                    @if(number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-3"></div>
                                            {{ number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}% Demo
                                        </div>
                                    @endif

                                    @if(number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-4"></div>
                                            {{ number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}% 0KM
                                        </div>
                                    @endif

                                    @if(number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice final">
                                            <div class="circle circle-5"></div>
                                            {{ number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}% In progress
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
                {{ $region->appointments }}, 
                {{ $region->data_count - $region->appointments }}
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
                {{ $region->new + $region->used + $region->demo + $region->zero_km }}, 
                {{ $region->appointments - $region->new - $region->used - $region->demo - $region->zero_km }}
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
                @if($region->new > 0)"#304651",@endif 
                @if($region->used > 0)"#262E33",@endif 
                @if($region->demo > 0)"#CDDEEA",@endif 
                @if($region->zero_km > 0)"#667681",@endif 
                @if($region->inprogress > 0)"#8A9FAD"@endif 
            ],
            data: [
                @if($region->new > 0){{ $region->new }},@endif 
                @if($region->used > 0){{ $region->used }},@endif 
                @if($region->demo > 0){{ $region->demo }},@endif 
                @if($region->zero_km > 0){{ $region->zero_km }},@endif 
                @if($region->inprogress > 0){{ $region->inprogress }}@endif
            ]
        }],
        labels: [
            @if($region->new > 0)"New",@endif 
            @if($region->used > 0)"Used",@endif 
            @if($region->demo > 0)"Demo",@endif 
            @if($region->zero_km > 0)"0km",@endif 
            @if($region->inprogress > 0)"In Progress"@endif 
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

<!--

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <h2><a href="{{ route('manufacturerCountry',[$region->manufacturer->id,$region->country->id]) }}">{{ $region->manufacturer->name }} {{ $region->country->name }}</a></h2>

                    <h3>{{ $region->name }}</h3>

                    <p><a href="{{ route('regionEdit',$region->id) }}">Edit</a></p>
                    
                    @if(count($region->dealerships) > 0)

                        <ul>

                            @foreach($region->dealerships as $dealership)

                                <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

                                @if(count($dealership->events) > 0)

                                    <ul>

                                        @foreach($dealership->events as $event)

                                            @foreach($event->manufacturers as $eventManufacturer)

                                                @if($eventManufacturer->id == $region->manufacturer->id)

                                                    <li><a href="{{ route('eventManufacturer',[$event->id,$region->manufacturer->id]) }}">{{ $event->name }}</a></li>

                                                @endif

                                            @endforeach

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

-->