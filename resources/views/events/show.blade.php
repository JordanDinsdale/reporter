@extends('layouts.app')

@section('page_title')

    <i class="fas fa-chart-pie"></i>Your Reports
    
@endsection

@section('content')

<div class="reports">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12 reporting-menu" id="test">

                <div class="reporting-menu-container">

                    <div id="toggleContainer" class="toggle-container">

                        <div class="current-results">

                            Showing results for event - {{ $event->name }} 

                            @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }}

                            @endif

                             - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}

                        </div>

                        <button id="hideBtn" class="open-button btn" onclick="openForm()">Change Results</button>
                        
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
                                                    @foreach($event->dealership->events as $dealershipEvent)
                                                        <li class="event-listing"><a href="{{ route('event',$dealershipEvent->id) }}">{{ $dealershipEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>Report By Date</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('dealershipReportDates', [$event->dealership->id]) }}">

                                                    @csrf

                                                    <div class="from-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  From date" />
                                                    </div>

                                                    <div class="to-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  To date" />
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

                                @if(count($event->manufacturers) > 1)
                                    <div class="checkbox">
                                        <input id="all" type="radio" name="brand" checked />
                                        <label for="all">All</label>
                                    </div>
                                @endif

                                @foreach($event->manufacturers as $manufacturer)
                                    <div class="checkbox">
                                        <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($event->manufacturers) == 1) checked @endif/>
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

                                @if(count($event->manufacturers) > 1)
                                    <option value="all" selected>All</option>
                                @endif

                                @foreach($event->manufacturers as $manufacturer)
                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($event->manufacturers) == 1) selected @endif>{{ $manufacturer->name }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    @if(count($event->manufacturers) > 1)

                        <div id="all">

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">

                                    <h3>Response Rate</h3>

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>

                                    <p>{{ $event->data_count }} Invites</p>

                                    <p>{{ $event->appointments }} Appointments</p>
                                    
                                </div>

                                <div class="col-md-4 donut-2">

                                    <h3>Conversion Rate</h3>

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>

                                    <p>{{ $event->appointments }} appointments</p>

                                    <p>{{ $event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress }} Sales</p>

                                </div>

                                <div class="col-md-4">

                                    <h3>Sales breakdown</h3>

                                    <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                    <div class="camembert-slice-container">

                                        @if(number_format($event->new/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-1"></div>
                                                {{ number_format($event->new/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',')}}% New
                                            </div>
                                        @endif

                                        @if(number_format($event->used/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-2"></div>
                                                {{ number_format($event->used/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',')}}% Used
                                            </div>
                                        @endif

                                        @if(number_format($event->demo/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-3"></div>
                                                {{ number_format($event->demo/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',')}}% Demo
                                            </div>
                                        @endif

                                        @if(number_format($event->zero_km/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-4"></div>
                                                {{ number_format($event->zero_km/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',')}}% 0KM
                                            </div>
                                        @endif

                                        @if(number_format($event->inprogress/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice final">
                                                <div class="circle circle-5"></div>
                                                {{ number_format($event->inprogress/($event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress) * 100, 1, '.', ',')}}% In progress
                                            </div>
                                        @endif

                                    </div>

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
                                                    {{ $event->data_count }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Appointments
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->appointments }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    New Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->new }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Used Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->used }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 table-content">
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Demo Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->demo }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    0km Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->zero_km }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    In Progress
                                                </div>
                                                <div class="data-count">
                                                    {{ $event->inprogress }}
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="col-md-12 download-table-btn">
                                            <a href="{{ route('eventDownload', $event->id) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                    @foreach($event->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($event->manufacturers) > 1) style="display:none; @endif">

                            @if($manufacturer->pivot->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">
                                        <h3>Response Rate</h3>
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                        <p>{{ $manufacturer->pivot->data_count }} Invites</p>
                                        <p>{{ $manufacturer->pivot->appointments }} Appointments</p>
                                    </div>

                                    <div class="col-md-4 donut-2">
                                        <h3>Conversion Rate</h3>
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                        <p>{{ $manufacturer->pivot->appointments }} appointments</p>
                                        <p>{{ $manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress }} Sales</p>
                                    </div>

                                    <div class="col-md-4">
                                        <h3>Sales breakdown</h3>
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                        <div class="camembert-slice-container">

                                            @if(number_format($manufacturer->pivot->new/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-1">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->new/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% New
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->used/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-2">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->used/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% Used
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->demo/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-3">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->demo/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% Demo
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->zero_km/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-4">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->zero_km/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% 0KM
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->inprogress/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice final">
                                                    <div class="circle circle-5">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->inprogress/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% In progress
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart">
                                        <div>
                                            <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-grouped" width="800" height="450"></canvas>
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
                                                        {{ $manufacturer->pivot->data_count }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Appointments
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->appointments }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        New Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->new }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Used Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->used }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 table-content">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        Demo Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->demo }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        0km Vehicles
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->zero_km }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        In Progress
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->inprogress }}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('eventManufacturerDownload', [$event->id,$manufacturer->id]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @else

                                <p>No information to display</p>

                                <a href="{{ route('eventEdit', $event->id) }}" class="btn">Add Data</a>

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
                {{ $event->appointments }}, 
                {{ $event->data_count - $event->appointments }}
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
                {{ $event->new + $event->used + $event->demo + $event->zero_km + $event->inprogress }}, 
                {{ $event->appointments - $event->new - $event->used - $event->demo - $event->zero_km - $event->inprogress }}
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
                @if($event->new > 0)"#304651",@endif
                @if($event->used > 0)"#262E33",@endif
                @if($event->demo > 0)"#CDDEEA",@endif
                @if($event->zero_km > 0)"#667681",@endif
                @if($event->inprogress > 0)"#8A9FAD"@endif
            ],
            data: [
                @if($event->new > 0){{ $event->new }},@endif 
                @if($event->used > 0){{ $event->used }},@endif 
                @if($event->demo > 0){{ $event->demo }},@endif 
                @if($event->zero_km > 0){{ $event->zero_km }},@endif 
                @if($event->inprogress > 0){{ $event->inprogress }}@endif
            ]
        }],
        labels: [
            @if($event->new > 0)"New",@endif 
            @if($event->used > 0)"Used",@endif 
            @if($event->demo > 0)"Demo",@endif 
            @if($event->zero_km > 0)"0km",@endif 
            @if($event->inprogress > 0)"In Progress"@endif 
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

@foreach($event->manufacturers as $manufacturer)

    @if($manufacturer->pivot->data_count > 0)

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
                        {{ $manufacturer->pivot->appointments }}, 
                        {{ $manufacturer->pivot->data_count - $manufacturer->pivot->appointments }}
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
                        {{ $manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress }}, 
                        {{ $manufacturer->pivot->appointments - $manufacturer->pivot->new - $manufacturer->pivot->used - $manufacturer->pivot->demo - $manufacturer->pivot->zero_km - $manufacturer->pivot->inprogress }}
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
                        @if($manufacturer->pivot->new > 0)"#304651",@endif 
                        @if($manufacturer->pivot->used > 0)"#262E33",@endif 
                        @if($manufacturer->pivot->demo > 0)"#CDDEEA",@endif 
                        @if($manufacturer->pivot->zero_km > 0)"#667681",@endif 
                        @if($manufacturer->pivot->inprogress > 0)"#8A9FAD"@endif 
                    ],
                    data: [
                        @if($manufacturer->pivot->new > 0){{ $manufacturer->pivot->new }},@endif 
                        @if($manufacturer->pivot->used > 0){{ $manufacturer->pivot->used }},@endif 
                        @if($manufacturer->pivot->demo > 0){{ $manufacturer->pivot->demo }},@endif 
                        @if($manufacturer->pivot->zero_km > 0){{ $manufacturer->pivot->zero_km }},@endif 
                        @if($manufacturer->pivot->inprogress > 0){{ $manufacturer->pivot->inprogress }}@endif
                    ]
                }],
                labels: [
                    @if($manufacturer->pivot->new > 0)"New",@endif 
                    @if($manufacturer->pivot->used > 0)"Used",@endif 
                    @if($manufacturer->pivot->demo > 0)"Demo",@endif 
                    @if($manufacturer->pivot->zero_km > 0)"0km",@endif 
                    @if($manufacturer->pivot->inprogress > 0)"In Progress"@endif 
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-grouped"), {

            type: 'bar',

            data: {
                labels: ["Response", "Conversion"],
                datasets: [

                    @if($manufacturer->region_appointments > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($manufacturer->region_appointments/$manufacturer->region_data_count * 100, 1, '.', ',') }},
                                {{ number_format(($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress)/$manufacturer->region_appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    {
                        label: "Country",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format($manufacturer->country_appointments/$manufacturer->country_data_count * 100, 1, '.', ',') }},
                            {{ number_format(($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress)/$manufacturer->country_appointments * 100, 1, '.', ',') }}
                        ]
                    }, 
                    {
                        label: "You",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format($manufacturer->pivot->appointments/$manufacturer->pivot->data_count * 100, 1, '.', ',') }},
                            {{ number_format(($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress)/$manufacturer->pivot->appointments * 100, 1, '.', ',') }}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: 'Response and Conversion Rate'
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
                    @if($manufacturer->region)
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
                            {{ number_format($manufacturer->pivot->new/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->pivot->used/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->pivot->demo/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->pivot->zero_km/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($manufacturer->pivot->inprogress/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',')}}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: 'Sales Breakdown'
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

                    <h2>{{ $event->name }}</h2>

                    <p><a href="{{ route('dealership', $event->dealership->id) }}">{{ $event->dealership->name }}</a></p>

                    @if($event->dealership->group)

                        <p><a href="{{ route('group', $event->dealership->group->id) }}">{{ $event->dealership->group->name }}</a></p>

                    @endif

                    <h3>Update Event</h3>

                    <form method="post" action="{{ route('eventUpdate', $event->id) }}">
                        @csrf
                        <div class="form-group">    
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $event->name }}" required />
                        </div>      
                        <div class="form-group">    
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control start_date" value="{{ date('d-m-Y', strtotime($event->start_date)) }}" required />
                            <input type="hidden" class="alt_start_date" name="start_date" value="{{ $event->start_date }}" required />
                        </div>    
                        <div class="form-group">    
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control end_date" value="{{ date('d-m-Y', strtotime($event->end_date)) }}" required />
                            <input type="hidden" class="alt_end_date" name="end_date" value="{{ $event->end_date }}" required />
                        </div>  
                        <div class="form-group">        
                            <label for="manufacturer_ids">Manufacturers</label>
                            @foreach($event->dealership->manufacturers as $manufacturer)
                                <label><input type="checkbox" name="manufacturer_ids[]" value="{{ $manufacturer->id }}"  @if(in_array($manufacturer->id,$event_manufacturer_ids)) checked @endif />{{ $manufacturer->name }}</label>
                            @endforeach
                        </div>
                        <input type="hidden" class="form-control" name="dealership_id" value="{{ $event->dealership->id }}" />
                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </form>

                    @foreach($event->manufacturers->sortBy('name') as $manufacturer)

                        <h4>{{ $manufacturer->name }}</h4>

                        <form method="post" action="{{ route('eventUpdateSync', [$event->id, $manufacturer->id]) }}">
                            @csrf
                            <div class="form-group">    
                                <label for="data_count">Data Count</label>
                                <input type="number" class="form-control" name="data_count" value="{{ $manufacturer->pivot->data_count }}" required />
                            </div>         
                            <div class="form-group">    
                                <label for="appointments">Appointments</label>
                                <input type="number" class="form-control" name="appointments" value="{{ $manufacturer->pivot->appointments }}" required />
                            </div>          
                            <div class="form-group">    
                                <label for="new">New Vehicle Sales</label>
                                <input type="number" class="form-control" name="new" value="{{ $manufacturer->pivot->new }}" required />
                            </div>           
                            <div class="form-group">    
                                <label for="used">Used Vehicle Sales</label>
                                <input type="number" class="form-control" name="used" value="{{ $manufacturer->pivot->used }}" required />
                            </div>            
                            <div class="form-group">    
                                <label for="zero_km">0km Vehicle Sales</label>
                                <input type="number" class="form-control" name="zero_km" value="{{ $manufacturer->pivot->zero_km }}" required />
                            </div>            
                            <div class="form-group">    
                                <label for="demo">Demo Vehicle Sales</label>
                                <input type="number" class="form-control" name="demo" value="{{ $manufacturer->pivot->demo }}" required />
                            </div>           
                            <div class="form-group">    
                                <label for="inprogress">In Progress Vehicle Sales</label>
                                <input type="number" class="form-control" name="inprogress" value="{{ $manufacturer->pivot->inprogress }}" required />
                            </div>    
                            <button type="submit" class="btn btn-primary">Update {{ $manufacturer->name }}</button>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        $( function() {

            $( ".start_date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                altFormat: "yy-mm-dd",
                altField: ".alt_start_date"
            });

            $( ".end_date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                altFormat: "yy-mm-dd",
                altField: ".alt_end_date"
            });

        } );
    </script>

@endsection

-->
