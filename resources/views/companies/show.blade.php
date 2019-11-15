@extends('layouts.app')

@section('page_title')

    <h1>{{ __('Dashboard') }}</h1>

    <p>{{ __('Year-to-Date Results') }}</p>
    
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

                                <h3>{{ __('Response Rate') }}</h3>

                                @if($company->data_count > 0)

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $company->data_count }} {{ __('Invites') }}</p>
                                    <p>{{ $company->appointments }} {{ __('Appointments') }}</p>
                                    <p>{{ number_format($company->appointments/$company->data_count * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>{{ __('No information to display') }}</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4 donut-2">

                            <div class="donut2-content">

                                <h3>{{ __('Conversion Rate') }}</h3>

                                @if($company->appointments > 0)

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    
                                    <p>{{ $company->appointments }} {{ __('Appointments') }}</p>
                                    <p>{{ $company->new + $company->used + $company->demo + $company->zero_km }} {{ __('Sales') }}</p>
                                    <p>{{ number_format(($company->new + $company->used + $company->demo + $company->zero_km)/$company->appointments * 100, 1, '.', ',') }}%</p>

                                @else

                                    <p>{{ __('No information to display') }}</p>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-4">

                            <h3>{{ __('Sales Breakdown') }}</h3>

                            @if($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress > 0)

                                <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                
                                <div class="camembert-slice-container">

                                    @if(number_format($company->new/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-1"></div>
                                            {{ number_format($company->new/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% {{ __('New') }}
                                        </div>
                                    @endif

                                    @if(number_format($company->used/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-2"></div>
                                            {{ number_format($company->used/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% {{ __('Used') }}
                                        </div>
                                    @endif

                                    @if(number_format($company->demo/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-3"></div>
                                            {{ number_format($company->demo/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% {{ __('Demo') }}
                                        </div>
                                    @endif

                                    @if(number_format($company->zero_km/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice">
                                            <div class="circle circle-4"></div>
                                            {{ number_format($company->zero_km/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% {{ __('0km') }}
                                        </div>
                                    @endif

                                    @if(number_format($company->inprogress/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                        <div class="camembert-slice final">
                                            <div class="circle circle-5"></div>
                                            {{ number_format($company->inprogress/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% {{ __('In Progress') }}
                                        </div>
                                    @endif

                                </div>

                            @else

                                <div class="row results cardc">

                                    <p>{{ __('No information to display') }}</p>

                                </div>

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
                {{ $company->appointments }}, 
                {{ $company->data_count - $company->appointments }}
            ]
        }],
        labels: [
            "{{ __('Appointments') }}",
            "{{ __('No Appointment Made') }}"
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
                {{ $company->new + $company->used + $company->demo + $company->zero_km }}, 
                {{ $company->appointments - $company->new - $company->used - $company->demo - $company->zero_km }}
            ]
        }],
        labels: [
            "{{ __('Sales') }}",
            "{{ __('No Sale Made') }}"
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
                @if($company->new > 0)"#304651",@endif 
                @if($company->used > 0)"#262E33",@endif 
                @if($company->demo > 0)"#CDDEEA",@endif 
                @if($company->zero_km > 0)"#667681",@endif 
                @if($company->inprogress > 0)"#8A9FAD"@endif 
            ],
            data: [
                @if($company->new > 0){{ $company->new }},@endif 
                @if($company->used > 0){{ $company->used }},@endif 
                @if($company->demo > 0){{ $company->demo }},@endif 
                @if($company->zero_km > 0){{ $company->zero_km }},@endif 
                @if($company->inprogress > 0){{ $company->inprogress }}@endif
            ]
        }],
        labels: [
            @if($company->new > 0)"{{ __('New') }}",@endif 
            @if($company->used > 0)"{{ __('Used') }}",@endif 
            @if($company->demo > 0)"{{ __('Demo') }}",@endif 
            @if($company->zero_km > 0)"{{ __('0km') }}",@endif 
            @if($company->inprogress > 0)"{{ __('In Progress') }}"@endif 
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