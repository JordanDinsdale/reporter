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

                            Showing results for manufacturer - {{ $manufacturer->name }} 

                            @if(\Carbon\Carbon::parse($manufacturer->start_date)->format('M') == \Carbon\Carbon::parse($manufacturer->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($manufacturer->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($manufacturer->start_date)->format('d M') }}

                                @if(\Carbon\Carbon::parse($manufacturer->start_date)->format('Y') !== \Carbon\Carbon::parse($manufacturer->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($manufacturer->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($manufacturer->end_date)->format('d M Y') }}

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
                                                    @foreach($manufacturer->events as $manufacturerEvent)
                                                        <li class="event-listing"><a href="{{ route('eventManufacturer',[$manufacturerEvent->id,$manufacturer->id]) }}">{{ $manufacturerEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>Report By Date</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('manufacturerReportDates',$manufacturer->id) }}">

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

                <div class="col-md-12 main-content">

                    <div class="row">

                        <div class="col-md-12 filter-mobile">

                            Filter results

                            <select name="brand-mobile">

                                <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" selected>{{ $manufacturer->name }}</option>

                            </select>

                        </div>

                    </div>

                    <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">

                        @if($manufacturer->data_count > 0)

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">
                                    <h3>Response Rate</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                    <p>{{ $manufacturer->data_count }} Invites</p>
                                    <p>{{ $manufacturer->appointments }} Appointments</p>

                                    @if($manufacturer->data_count > 0)

                                        <p>{{ number_format($manufacturer->appointments/$manufacturer->data_count * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4 donut-2">
                                    <h3>Conversion Rate</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    <p>{{ $manufacturer->appointments }} appointments</p>
                                    <p>{{ $manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress }} Sales</p>

                                    @if($manufacturer->appointments > 0)

                                        <p>{{ number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4">
                                    <h3>Sales breakdown</h3>
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
                                            <a href="{{ route('manufacturerReportDatesDownload', [$manufacturer->id,$manufacturer->start_date,$manufacturer->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
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

@endif

@endsection