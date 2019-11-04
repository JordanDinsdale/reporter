@extends('layouts.app')

@section('page_title')

    <h1><i class="fas fa-chart-pie"></i>Your Reports</h1>
    
@endsection

@section('content')

<div class="reports">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12 reporting-menu" id="test">

                <div class="reporting-menu-container">

                    <div id="toggleContainer" class="toggle-container">

                        <div class="current-results">

                            Showing results for dealership - {{ $dealership->name }} 

                            @if(\Carbon\Carbon::parse($dealership->start_date)->format('M') == \Carbon\Carbon::parse($dealership->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($dealership->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($dealership->start_date)->format('d M') }}

                                @if(\Carbon\Carbon::parse($dealership->start_date)->format('Y') !== \Carbon\Carbon::parse($dealership->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($dealership->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($dealership->end_date)->format('d M Y') }}

                        </div>

                        <button id="hideBtn" class="open-button btn" onclick="openForm()">Choose Report</button>
                        
                        <button id="cancel" type="button" class="cancel" onclick="closeForm()" style="display: none;"><i class="fas fa-times"></i></button>

                        <div class="clear"></div>

                    </div>

                    <div class="report-dropdown">

                        <div class="form-popup" id="reportForm">

                            <div class="container-fluid report-menu-inner">

                                <div class="container">

                                    <div class="row">

                                        <div class="col-md-5" >

                                            <h4>Report By Event</h4>

                                            <div class="event-list-container">
                                                <ul>
                                                    @foreach($dealership->events as $dealershipEvent)
                                                        <li class="event-listing"><a href="{{ route('event',$dealershipEvent->id) }}">{{ $dealershipEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>Report By Date</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('dealershipEvents', [$dealership->id]) }}">

                                                    @csrf

                                                    <div class="from-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  From date" required />
                                                    </div>

                                                    <div class="to-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  To date" required />
                                                    </div>

                                                    <button type="submit" class="btn">REPORT</button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="main-content-container" class="container-fluid bg-custom">

        <div class="container main-content-container">

            <div class="row">

                <div class="col-md-2 sidebar">

                    <div class="sidebar-inner">

                        <h3>Filter results</h3>

                        <div class="filter-group">

                            <h4>Brands</h4>

                            <form id="brandSelect">

                                @if(count($dealership->manufacturers) > 1)
                                    <div class="checkbox">
                                        <input id="all" type="radio" name="brand" checked />
                                        <label for="all">All</label>
                                    </div>
                                @endif

                                @foreach($dealership->manufacturers as $manufacturer)
                                    <div class="checkbox">
                                        <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($dealership->manufacturers) == 1) checked @endif/>
                                        <label for="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">{{ $manufacturer->name }}</label>
                                    </div>
                                @endforeach

                            </form>

                        </div>

                    </div>

                </div>

                <div class="col-md-10 main-content">

                    <div class="row">

                        <div class="col-md-12 filter-mobile">

                            Filter results

                            <select name="brand-mobile">

                                @if(count($dealership->manufacturers) > 1)
                                    <option value="all" selected>All</option>
                                @endif

                                @foreach($dealership->manufacturers as $manufacturer)
                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($dealership->manufacturers) == 1) selected @endif>{{ $manufacturer->name }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    @if(count($dealership->manufacturers) > 1)

                        <div id="all">

                            @if($dealership->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">

                                        <h3>Response Rate</h3>

                                        <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>

                                        <p>{{ $dealership->data_count }} Invites</p>

                                        <p>{{ $dealership->appointments }} Appointments</p>

                                        @if($dealership->data_count > 0)

                                            <p>{{ number_format($dealership->appointments/$dealership->data_count * 100, 1, '.', ',') }}%</p>

                                        @endif

                                    </div>

                                    <div class="col-md-4 donut-2">

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

                                    <div class="col-md-4">

                                        <h3>Sales breakdown</h3>

                                        @if($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress > 0)

                                            <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                            <div class="camembert-slice-container">

                                                @if(number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-1">
                                                        </div>
                                                        {{ number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% New
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-2">
                                                        </div>
                                                        {{ number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% Used
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-3">
                                                        </div>
                                                        {{ number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% Demo
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-4">
                                                        </div>
                                                        {{ number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% 0KM
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice final">
                                                        <div class="circle circle-5">
                                                        </div>
                                                        {{ number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% In progress
                                                    </div>
                                                @endif

                                            </div>

                                        @else

                                            <p>No information to display</p>

                                        @endif

                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 sales-breakdown-table">
                                        <div class="row">
                                            <div class="col-md-12 results-title">
                                                <h3>Breakdown of results</h3>
                                            </div>
                                            <div class="col-md-6 table-content ">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Data Count
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->data_count }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Appointments
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->appointments }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        New Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->new }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Used Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->used }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 table-content">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Demo Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->demo }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        0km Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->zero_km }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        In Progress
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->inprogress }}
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('dealershipDownload', [$dealership->id,$dealership->start_date,$dealership->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @else

                                <div class="row results cardc">

                                    <p>No information to display</p>

                                </div>

                            @endif

                        </div>

                    @endif

                    @foreach($dealership->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($dealership->manufacturers) > 1) style="display:none; @endif">

                            @if($manufacturer->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">

                                        <h3>Response Rate</h3>

                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>

                                        <p>{{ $manufacturer->data_count }} Invites</p>

                                        <p>{{ $manufacturer->appointments }} Appointments</p>

                                        <p>{{ number_format($manufacturer->appointments/$manufacturer->data_count * 100, 1, '.', ',') }}%</p>

                                    </div>

                                    <div class="col-md-4 donut-2">

                                        <h3>Conversion Rate</h3>

                                        @if($manufacturer->appointments > 0)

                                            <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>

                                            <p>{{ $manufacturer->appointments }} appointments</p>

                                            <p>{{ $manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km }} Sales</p>

                                            <p>{{ number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 1, '.', ',') }}%</p>

                                        @endif

                                    </div>

                                    <div class="col-md-4">

                                        <h3>Sales breakdown</h3>

                                        @if($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress > 0)

                                            <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                            <div class="camembert-slice-container">

                                                @if(number_format($manufacturer->new/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-1">
                                                        </div>
                                                        {{ number_format($manufacturer->new/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') }}% New
                                                    </div>
                                                @endif

                                                @if(number_format($manufacturer->used/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-2">
                                                        </div>
                                                        {{ number_format($manufacturer->used/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') }}% Used
                                                    </div>
                                                @endif

                                                @if(number_format($manufacturer->demo/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-3">
                                                        </div>
                                                        {{ number_format($manufacturer->demo/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') }}% Demo
                                                    </div>
                                                @endif

                                                @if(number_format($manufacturer->zero_km/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-4">
                                                        </div>
                                                        {{ number_format($manufacturer->zero_km/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') }}% 0KM
                                                    </div>
                                                @endif

                                                @if(number_format($manufacturer->inprogress/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice final">
                                                        <div class="circle circle-5">
                                                        </div>
                                                        {{ number_format($manufacturer->inprogress/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',') }}% In progress
                                                    </div>
                                                @endif

                                            </div>

                                        @else

                                            <p>No information to display</p>

                                        @endif

                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart">
                                        <div>
                                            <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-response" width="800" height="450"></canvas>
                                        </div>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart">
                                        <div>
                                            <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-conversion" width="800" height="450"></canvas>
                                        </div>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart-2">
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-breakdown" width="800" height="450"></canvas>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 sales-breakdown-table">
                                        <div class="row">
                                            <div class="col-md-12 results-title">
                                                <h3>Breakdown of results</h3>
                                            </div>
                                            <div class="col-md-6 table-content ">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Data Count
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->data_count }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Appointments
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->appointments }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        New Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->new }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Used Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->used }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 table-content">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Demo Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->demo }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        0km Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->zero_km }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        In Progress
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->inprogress }}
                                                    </div>
                                                </div>

                                            </div>
                                        
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('dealershipDownloadManufacturer', [$dealership->id,$manufacturer->id,$dealership->start_date,$dealership->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @else

                                <div class="row results cardc">

                                    <p>No information to display</p>

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    function openForm() {
        $(".report-dropdown").slideDown();
        document.getElementById("hideBtn").style.display = "none";
        document.getElementById("cancel").style.display = "inline-block";
        document.getElementById("toggleContainer").style.border = "none";
        document.getElementById("main-content-container").style.opacity = "0.5";
    }

    function closeForm() {
        $(".report-dropdown").slideUp();
        document.getElementById("hideBtn").style.display = "inline-block";
        document.getElementById("cancel").style.display = "none";
        document.getElementById("toggleContainer").style.border = "1px solid #E0E0E0";
        document.getElementById("main-content-container").style.opacity = "1";
    }
</script>

<script type="text/javascript">

    $('#iconified').on('keyup', function() {
        var input = $(this);
        if(input.val().length === 0) {
            input.addClass('empty');
        } else {
            input.removeClass('empty');
        }
    });

</script>



<script type="text/javascript">

    $(document).ready(function () {

        $('#brandSelect').on('change', function() {

            $('.results').hide();
            selectedBrand = $('input[type=radio][name=brand]:checked').attr('id');
            $('div#' + selectedBrand).show();
            $('div#' + selectedBrand + ' .results').show();

        });

    });

</script>


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
        cutoutPercentage: 50,
        legend: {
            display: false,
        }
    }
});

</script>


@foreach($dealership->manufacturers as $manufacturer)

    @if($manufacturer->data_count > 0)

        <script type="text/javascript">

        var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate').getContext('2d');
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
                        {{ $manufacturer->appointments }}, 
                        {{ $manufacturer->data_count - $manufacturer->appointments }}
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

        var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate').getContext('2d');
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
                        {{ $manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km }}, 
                        {{ $manufacturer->appointments - $manufacturer->new - $manufacturer->used - $manufacturer->demo - $manufacturer->zero_km }}
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

        var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-salesBreakdown').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                datasets: [{
                    borderWidth: '0',
                    backgroundColor: [
                        @if($manufacturer->new > 0)"#304651",@endif 
                        @if($manufacturer->used > 0)"#262E33",@endif 
                        @if($manufacturer->demo > 0)"#CDDEEA",@endif 
                        @if($manufacturer->zero_km > 0)"#667681",@endif 
                        @if($manufacturer->inprogress > 0)"#8A9FAD"@endif 
                    ],
                    data: [
                        @if($manufacturer->new > 0){{ $manufacturer->new }},@endif 
                        @if($manufacturer->used > 0){{ $manufacturer->used }},@endif 
                        @if($manufacturer->demo > 0){{ $manufacturer->demo }},@endif 
                        @if($manufacturer->zero_km > 0){{ $manufacturer->zero_km }},@endif 
                        @if($manufacturer->inprogress > 0){{ $manufacturer->inprogress }}@endif
                    ]
                }],
                labels: [
                    @if($manufacturer->new > 0)"New",@endif 
                    @if($manufacturer->used > 0)"Used",@endif 
                    @if($manufacturer->demo > 0)"Demo",@endif 
                    @if($manufacturer->zero_km > 0)"0km",@endif 
                    @if($manufacturer->inprogress > 0)"In Progress"@endif 
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


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["Response"],
                datasets: [

                    @if($manufacturer->region_appointments > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($manufacturer->region_appointments/$manufacturer->region_data_count * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    {
                        label: "Country",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format($manufacturer->country_appointments/$manufacturer->country_data_count * 100, 1, '.', ',') }}
                        ]
                    }, 
                    {
                        label: "You",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format($manufacturer->appointments/$manufacturer->data_count * 100, 1, '.', ',') }}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: 'Response Rate %'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            max: 5
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var allData = data.datasets[tooltipItem.datasetIndex].data;
                            var tooltipLabel = data.datasets[tooltipItem.datasetIndex].label;
                            var tooltipData = allData[tooltipItem.index];
                            return tooltipLabel + ": " + tooltipData + "%";
                        }
                    }
                }

            }

        });

        </script>


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-conversion"), {

            type: 'bar',

            data: {
                labels: ["Conversion"],
                datasets: [

                    @if($manufacturer->region_appointments > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km)/$manufacturer->region_appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    {
                        label: "Country",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format(($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km)/$manufacturer->country_appointments * 100, 1, '.', ',') }}
                        ]
                    }, 
                    {
                        label: "You",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 1, '.', ',') }}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: 'Conversion Rate %'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            max: 100
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var allData = data.datasets[tooltipItem.datasetIndex].data;
                            var tooltipLabel = data.datasets[tooltipItem.datasetIndex].label;
                            var tooltipData = allData[tooltipItem.index];
                            return tooltipLabel + ": " + tooltipData + "%";
                        }
                    }
                }

            }

        });

        </script>


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-breakdown"), {

            type: 'bar',

            data: {
                labels: ["New", "Used", "Demo", "0KM", "In Progress"],
                datasets: [
                    @if($manufacturer->region_data_count > 0)
                    {
                        label: "Region",
                        backgroundColor: "#333C42",
                        data: [
                            @if($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress > 0)
                                {{ number_format($manufacturer->region_new/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->region_used/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->region_demo/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->region_zero_km/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->region_inprogress/($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress) * 100, 1, '.', ',')}}
                            @endif
                        ]
                    }, 
                    @endif
                    {
                        label: "Country",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format($manufacturer->country_new/($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->country_used/($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->country_demo/($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->country_zero_km/($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->country_inprogress/($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress) * 100, 1, '.', ',')}}
                        ]
                    }, 
                    {
                        label: "You",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format($manufacturer->new/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->used/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->demo/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->zero_km/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->inprogress/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: 'Sales Breakdown %'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            max: 100
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var allData = data.datasets[tooltipItem.datasetIndex].data;
                            var tooltipLabel = data.datasets[tooltipItem.datasetIndex].label;
                            var tooltipData = allData[tooltipItem.index];
                            return tooltipLabel + ": " + tooltipData + "%";
                        }
                    }
                }
            }

        });

        </script>

    @endif

@endforeach

@endsection