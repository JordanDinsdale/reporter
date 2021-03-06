@extends('layouts.app')

@section('page_title')

    <h1><i class="fas fa-chart-pie"></i>{{ __('Your Reports') }}</h1>
    
@endsection

@section('content')

<div class="reports">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12 reporting-menu" id="test">

                <div class="reporting-menu-container">

                    <div id="toggleContainer" class="toggle-container">

                        <div class="current-results">

                            {{ __('Showing results for Event') }} | {{ __($event->name) }} | 

                            @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }}

                            @endif

                             - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}

                        </div>

                        <button id="hideBtn" class="open-button btn" onclick="openForm()">{{ __('Choose Report') }}</button>
                        
                        <button id="cancel" type="button" class="cancel" onclick="closeForm()" style="display: none;"><i class="fas fa-times"></i></button>

                        <div class="clear"></div>

                    </div>

                    <div class="report-dropdown">

                        <div class="form-popup" id="reportForm">

                            <div class="container-fluid report-menu-inner">

                                <div class="container">

                                    <div class="row">

                                        <div class="col-md-5" >

                                            <h4>{{ __('Report By Event') }}</h4>

                                            <div class="event-list-container">
                                                <ul>
                                                    @foreach($dealership->events as $dealershipEvent)
                                                        <li class="event-listing"><a href="{{ route('event',$dealershipEvent->id) }}">{{ __($dealershipEvent->name) }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>{{ __('Report By Date') }}</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('dealershipReports', [$dealership->id]) }}">

                                                    @csrf

                                                    <div class="from-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  {{ __('From date') }}" required />
                                                    </div>

                                                    <div class="to-date">
                                                        <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  {{ __('To date') }}" required />
                                                    </div>

                                                    <button type="submit" class="btn">{{ __('REPORT') }}</button>

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

                        <h3>{{ __('Filter Results') }}</h3>

                        <div class="filter-group">

                            <h4>{{ __('Brands') }}</h4>

                            <form id="brandSelect">

                                @if(count($event->manufacturers) > 1)
                                    <div class="checkbox">
                                        <input id="all" type="radio" name="brand" checked />
                                        <label for="all">{{ __('All') }}</label>
                                    </div>
                                @endif

                                @foreach($event->manufacturers as $manufacturer)
                                    <div class="checkbox">
                                        <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($event->manufacturers) == 1) checked @endif/>
                                        <label for="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">{{ __($manufacturer->name) }}</label>
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
                                    <option value="all" selected>{{ __('All') }}</option>
                                @endif

                                @foreach($event->manufacturers as $manufacturer)
                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($event->manufacturers) == 1) selected @endif>{{ __($manufacturer->name) }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    @if(count($event->manufacturers) > 1)

                        <div id="all">

                            @if($dealership->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">

                                        <h3>{{ __('Response Rate') }}</h3>

                                        <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>

                                        <p>{{ $dealership->data_count }} {{ __('Invites') }}</p>

                                        <p>{{ $dealership->appointments }} {{ __('Appointments') }}</p>
                                        
                                        <p>{{ number_format($dealership->appointments/$dealership->data_count * 100, 1, '.', ',') }}%</p>

                                    </div>

                                    <div class="col-md-4 donut-2">

                                        <h3>{{ __('Conversion Rate') }}</h3>

                                        @if($dealership->appointments > 0)

                                            <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>

                                            <p>{{ $dealership->appointments }} {{ __('Appointments') }}</p>

                                            <p>{{ $dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km }} {{ __('Sales') }}</p>

                                            <p>{{ number_format(($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km)/$dealership->appointments * 100, 1, '.', ',') }}%</p>

                                        @else

                                            <p>{{ __('No information to display') }}</p>

                                        @endif

                                    </div>

                                    <div class="col-md-4">

                                        <h3>{{ __('Sales Breakdown') }}</h3>

                                        @if($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress > 0)

                                            <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                            <div class="camembert-slice-container">

                                                @if(number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-1">
                                                        </div>
                                                        {{ number_format($dealership->new/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% {{ __('New') }}
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-2">
                                                        </div>
                                                        {{ number_format($dealership->used/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% {{ __('Used') }}
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-3">
                                                        </div>
                                                        {{ number_format($dealership->demo/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% {{ __('Demo') }}
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice">
                                                        <div class="circle circle-4">
                                                        </div>
                                                        {{ number_format($dealership->zero_km/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% {{ __('0km') }}
                                                    </div>
                                                @endif

                                                @if(number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',') > 0)
                                                    <div class="camembert-slice final">
                                                        <div class="circle circle-5">
                                                        </div>
                                                        {{ number_format($dealership->inprogress/($dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress) * 100, 1, '.', ',')}}% {{ __('In Progress') }}
                                                    </div>
                                                @endif

                                            </div>

                                        @else

                                            <p>{{ __('No information to display') }}</p>

                                        @endif

                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 sales-breakdown-table">
                                        <div class="row">
                                            <div class="col-md-12 results-title">
                                                <h3>{{ __('Breakdown of Results') }}</h3>
                                            </div>
                                            <div class="col-md-6 table-content ">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Data Count') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->data_count }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Appointments') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->appointments }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('New Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->new }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Used Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->used }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 table-content">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Demo Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->demo }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('0km Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->zero_km }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('In Progress') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $dealership->inprogress }}
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('eventDownload', $event->id) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @else

                                <div class="row results cardc">

                                    <p>{{ __('No information to display') }}</p>

                                    <a href="{{ route('eventEdit', $event->id) }}" class="btn">{{ __('Add Data') }}</a>

                                </div>

                            @endif

                        </div>

                    @endif

                    @foreach($event->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($event->manufacturers) > 1) style="display:none;" @endif>

                            @if($manufacturer->pivot->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">

                                        <h3>{{ __('Response Rate') }}</h3>

                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>

                                        <p>{{ $manufacturer->pivot->data_count }} {{ __('Invites') }}</p>

                                        <p>{{ $manufacturer->pivot->appointments }} {{ __('Appointments') }}</p>
                                    
                                        <p>{{ number_format($manufacturer->pivot->appointments/$manufacturer->pivot->data_count * 100, 1, '.', ',') }}%</p>

                                    </div>

                                    <div class="col-md-4 donut-2">

                                        <h3>Conversion Rate</h3>

                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>

                                        <p>{{ $manufacturer->pivot->appointments }} {{ __('Appointments') }}</p>

                                        <p>{{ $manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress }} {{ __('Sales') }}</p>

                                        <p>{{ number_format(($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km)/$manufacturer->pivot->appointments * 100, 1, '.', ',') }}%</p>

                                    </div>

                                    <div class="col-md-4">

                                        <h3>{{ __('Sales Breakdown') }}</h3>

                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                        <div class="camembert-slice-container">

                                            @if(number_format($manufacturer->pivot->new/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-1">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->new/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% {{ __('New') }}
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->used/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-2">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->used/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% {{ __('Used') }}
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->demo/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-3">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->demo/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% {{ __('Demo') }}
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->zero_km/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice">
                                                    <div class="circle circle-4">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->zero_km/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% {{ __('0km') }}
                                                </div>
                                            @endif

                                            @if(number_format($manufacturer->pivot->inprogress/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') > 0)
                                                <div class="camembert-slice final">
                                                    <div class="circle circle-5">
                                                    </div>
                                                    {{ number_format($manufacturer->pivot->inprogress/($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress) * 100, 1, '.', ',') }}% {{ __('In Progress') }}
                                                </div>
                                            @endif

                                        </div>

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
                                                <h3>{{ __('Breakdown of Results') }}</h3>
                                            </div>
                                            <div class="col-md-6 table-content ">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Data Count') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->data_count }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Appointments') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->appointments }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('New Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->new }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Used Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->used }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 table-content">
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('Demo Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->demo }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('0km Vehicles') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->zero_km }}
                                                    </div>
                                                </div>
                                                <div class="data-line">
                                                    <div class="data-type">
                                                        {{ __('In Progress') }}
                                                    </div>
                                                    <div class="data-count">
                                                        {{ $manufacturer->pivot->inprogress }}
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('eventManufacturerDownload', [$event->id,$manufacturer->id]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @else

                                <div class="row results cardc">

                                    <p>{{ __('No information to display') }}</p>

                                    <a href="{{ route('eventEdit', $event->id) }}" class="btn">{{ __('Add Data') }}</a>

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
                {{ $dealership->new + $dealership->used + $dealership->demo + $dealership->zero_km + $dealership->inprogress }}, 
                {{ $dealership->appointments - $dealership->new - $dealership->used - $dealership->demo - $dealership->zero_km - $dealership->inprogress }}
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
            @if($dealership->new > 0)"{{ __('New') }}",@endif 
            @if($dealership->used > 0)"{{ __('Used') }}",@endif 
            @if($dealership->demo > 0)"{{ __('Demo') }}",@endif 
            @if($dealership->zero_km > 0)"{{ __('0km') }}",@endif 
            @if($dealership->inprogress > 0)"{{ __('In Progress') }}"@endif 
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
                    @if($manufacturer->pivot->new > 0)"{{ __('New') }}",@endif 
                    @if($manufacturer->pivot->used > 0)"{{ __('Used') }}",@endif 
                    @if($manufacturer->pivot->demo > 0)"{{ __('Demo') }}",@endif 
                    @if($manufacturer->pivot->zero_km > 0)"{{ __('0km') }}",@endif 
                    @if($manufacturer->pivot->inprogress > 0)"{{ __('In Progress') }}"@endif 
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
                labels: ["{{ __('Response') }}"],
                datasets: [

                    @if($manufacturer->region_appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($manufacturer->region_appointments/$manufacturer->region_data_count * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    {
                        label: "{{ __('Country') }}",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format($manufacturer->country_appointments/$manufacturer->country_data_count * 100, 1, '.', ',') }}
                        ]
                    }, 
                    {
                        label: "{{ __('You') }}",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format($manufacturer->pivot->appointments/$manufacturer->pivot->data_count * 100, 1, '.', ',') }}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Response Rate %') }}"
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
                labels: ["{{ __('Conversion') }}"],
                datasets: [

                    @if($manufacturer->region_appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($manufacturer->region_new + $manufacturer->region_used + $manufacturer->region_demo + $manufacturer->region_zero_km + $manufacturer->region_inprogress)/$manufacturer->region_appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    {
                        label: "{{ __('Country') }}",
                        backgroundColor: "#6D497F",
                        data: [
                            {{ number_format(($manufacturer->country_new + $manufacturer->country_used + $manufacturer->country_demo + $manufacturer->country_zero_km + $manufacturer->country_inprogress)/$manufacturer->country_appointments * 100, 1, '.', ',') }}
                        ]
                    }, 
                    {
                        label: "{{ __('You') }}",
                        backgroundColor: "#BA97CC",
                        data: [
                            {{ number_format(($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km + $manufacturer->pivot->inprogress)/$manufacturer->pivot->appointments * 100, 1, '.', ',') }}
                        ]
                    }
                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Conversion Rate %') }}"
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
                labels: ["{{ __('New') }}", "{{ __('Used') }}", "{{ __('Demo') }}", "{{ __('0km') }}", "{{ __('In Progress') }}"],
                datasets: [
                    @if($manufacturer->region_data_count > 0)
                    {
                        label: "{{ __('Region') }}",
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
                        label: "{{ __('Country') }}",
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
                        label: "{{ __('You') }}",
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
                    text: "{{ __('Sales Breakdown %') }}"
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