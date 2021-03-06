@extends('layouts.app')

@section('page_title')

    <h1><i class="fas fa-chart-pie"></i>{{ __('YOUR REPORTS') }}</h1>
    
@endsection

@section('content')

<div class="reports">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12 reporting-menu" id="test">

                <div class="reporting-menu-container">

                    <div id="toggleContainer" class="toggle-container">

                        <div class="current-results">

                            {{ __('Showing results for') }}

                            @switch($level)

                                @case('Country')
                                    {{ __('Country') }} | {{ $country->manufacturer->name }} {{ $country->name }} | 
                                    @break

                                @case('Region')
                                    {{ __('Region') }} | {{ $country->manufacturer->name }} {{ $country->name }} {{ $country->region->name }} | 
                                    @break

                                @case('Dealership')
                                    {{ __('Dealership') }} | {{ $country->dealership->name }} | 
                                    @break

                                @default
                                    {{ __('Country') }} | {{ $country->manufacturer->name }} {{ $country->name }} | 

                            @endswitch

                            @if(\Carbon\Carbon::parse($country->start_date)->format('M') == \Carbon\Carbon::parse($country->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($country->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($event->end_date)->format('d') }} {{ __(\Carbon\Carbon::parse($event->end_date)->format('M')) }}

                                @if(\Carbon\Carbon::parse($country->start_date)->format('Y') !== \Carbon\Carbon::parse($country->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($country->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($event->end_date)->format('d') }} {{ __(\Carbon\Carbon::parse($event->end_date)->format('M')) }} {{ \Carbon\Carbon::parse($event->end_date)->format('Y') }}

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
                                                    @foreach($country->events as $countryEvent)
                                                        <li class="event-listing"><a href="{{ route('eventManufacturerCountry',[$countryEvent->id,$country->manufacturer->id]) }}">{{ $countryEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>{{ __('Report By Date') }}</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('manufacturerCountryReportDates',[$country->manufacturer->id,$country->id]) }}">

                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  {{ __('From date') }}" required />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  {{ __('To date') }}" required />
                                                        </div>

                                                        <div class="col-md-12">
                                                            <select id="levels" class="form-control" name="level" required>
                                                                <option value="">{{ __('Select Level') }}</option>
                                                                <option value="Country">{{ __($country->name) }}</option>
                                                                <option value="Region">{{ __('Region') }}</option>
                                                                <option value="Dealership">{{ __('Dealership') }}</option>
                                                            </select>
                                                        </div>

                                                        <select class="form-control d-none" name="manufacturer_id" id="manufacturers">
                                                            <option value="{{ $country->manufacturer->id }}" selected>{{ $country->manufacturer->name }}</option>
                                                        </select>
                                                        
                                                        <select class="form-control d-none" name="country_id" id="countries">
                                                            <option value="{{ $country->id }}" selected>{{ __($country->name) }}</option>
                                                        </select>

                                                        <div id="regionContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="region_id" id="regions">
                                                                <option value="">{{ __('Select Region') }}</option>
                                                                @foreach($country->regions as $region)
                                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div id="dealershipContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="dealership_id" id="dealerships">
                                                                <option value="">{{ __('Select Dealership') }}</option>
                                                                <option disabled="true" value="">{{ __('No dealerships currently available') }}</option>
                                                            </select>
                                                        </div>

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

                <div class="col-md-12 main-content">

                    <div class="row">

                        <div class="col-md-12 filter-mobile">

                            {{ __('Filter Results') }}

                            <select name="brand-mobile">

                                <option value="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}" selected>{{ $country->manufacturer->name }}</option>

                            </select>

                        </div>

                    </div>

                    <div id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}">

                        @if($country->data_count > 0)

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">
                                    <h3>Response Rate</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                    <p>{{ $country->data_count }} {{ __('Invites') }}</p>
                                    <p>{{ $country->appointments }} {{ __('Appointments') }}</p>

                                    @if($country->data_count > 0)

                                        <p>{{ number_format($country->appointments/$country->data_count * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4 donut-2">
                                    <h3>Conversion Rate</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    <p>{{ $country->appointments }} {{ __('Appointments') }}</p>
                                    <p>{{ $country->new + $country->used + $country->demo + $country->zero_km }} {{ __('Sales') }}</p>

                                    @if($country->appointments > 0)

                                        <p>{{ number_format(($country->new + $country->used + $country->demo + $country->zero_km)/$country->appointments * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4">
                                    <h3>{{ __('Sales Breakdown') }}</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                    <div class="camembert-slice-container">

                                        @if(number_format($country->new/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-1">
                                                </div>
                                                {{ number_format($country->new/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') }}% New
                                            </div>
                                        @endif

                                        @if(number_format($country->used/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-2">
                                                </div>
                                                {{ number_format($country->used/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') }}% Used
                                            </div>
                                        @endif

                                        @if(number_format($country->demo/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-3">
                                                </div>
                                                {{ number_format($country->demo/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') }}% Demo
                                            </div>
                                        @endif

                                        @if(number_format($country->zero_km/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-4">
                                                </div>
                                                {{ number_format($country->zero_km/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') }}% 0KM
                                            </div>
                                        @endif

                                        @if(number_format($country->inprogress/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice final">
                                                <div class="circle circle-5">
                                                </div>
                                                {{ number_format($country->inprogress/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',') }}% In progress
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            @if($level == 'Region' || $level == 'Dealership')

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart">
                                        <div>
                                            <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-response" width="800" height="450"></canvas>
                                        </div>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart">
                                        <div>
                                            <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-conversion" width="800" height="450"></canvas>
                                        </div>
                                    </div>

                                </div>

                                <div class="row results cardc">

                                    <div class="col-md-12 bar-chart-2">
                                        <canvas id="{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-breakdown" width="800" height="450"></canvas>
                                    </div>

                                </div>

                            @endif

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
                                                    {{ $country->data_count }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Appointments') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->appointments }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('New Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->new }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Used Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->used }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 table-content">
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Demo Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->demo }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('0km Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->zero_km }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('In Progress') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $country->inprogress }}
                                                </div>
                                            </div>

                                        </div>

                                        @if($level == 'Country')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('manufacturerCountryReportDatesDownload', [$country->manufacturer->id,$country->id,$country->start_date,$country->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        @elseif($level == 'Region')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('regionDownload', [$country->region->id,$country->start_date,$country->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        @elseif($level == 'Dealership')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('dealershipDownloadManufacturer', [$country->dealership->id,$country->manufacturer->id,$country->start_date,$country->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        @endif

                                    </div>
                                </div>

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


@if($country->data_count > 0)

    <script type="text/javascript">

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-responseRate').getContext('2d');
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
                    {{ $country->appointments }}, 
                    {{ $country->data_count - $country->appointments }}
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

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-conversionRate').getContext('2d');
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
                    {{ $country->new + $country->used + $country->demo + $country->zero_km }}, 
                    {{ $country->appointments - $country->new - $country->used - $country->demo - $country->zero_km }}
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

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-salesBreakdown').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            datasets: [{
                borderWidth: '0',
                backgroundColor: [
                    @if($country->new > 0)"#304651",@endif 
                    @if($country->used > 0)"#262E33",@endif 
                    @if($country->demo > 0)"#CDDEEA",@endif 
                    @if($country->zero_km > 0)"#667681",@endif 
                    @if($country->inprogress > 0)"#8A9FAD"@endif 
                ],
                data: [
                    @if($country->new > 0){{ $country->new }},@endif 
                    @if($country->used > 0){{ $country->used }},@endif 
                    @if($country->demo > 0){{ $country->demo }},@endif 
                    @if($country->zero_km > 0){{ $country->zero_km }},@endif 
                    @if($country->inprogress > 0){{ $country->inprogress }}@endif
                ]
            }],
            labels: [
                @if($country->new > 0)"{{ __('New') }}",@endif 
                @if($country->used > 0)"{{ __('Used') }}",@endif 
                @if($country->demo > 0)"{{ __('Demo') }}",@endif 
                @if($country->zero_km > 0)"{{ __('0km') }}",@endif 
                @if($country->inprogress > 0)"{{ __('In Progress') }}"@endif 
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


    @if($level == 'Region')


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Response') }}"],
                datasets: [

                    @if($country->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($country->appointments/$country->data_count * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($country->country->data_count > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($country->country->appointments/$country->country->data_count * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif

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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-conversion"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Conversion') }}"],
                datasets: [

                    @if($country->appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($country->new + $country->used + $country->demo + $country->zero_km)/$country->appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($country->country->appointments > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format(($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km)/$country->country->appointments * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-breakdown"), {

            type: 'bar',

            data: {
                labels: ["{{ __('New') }}", "{{ __('Used') }}", "{{ __('Demo') }}", "{{ __('0km') }}", "{{ __('In Progress') }}"],
                datasets: [

                    @if($country->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                @if($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress > 0)
                                    {{ number_format($country->new/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->used/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->demo/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->zero_km/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->inprogress/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        }, 
                    @endif

                    @if($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($country->country->new/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->used/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->demo/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->zero_km/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->inprogress/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}}
                            ]
                        }
                    @endif
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


    @elseif($level == 'Dealership')


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Response') }}"],
                datasets: [

                    @if($country->country->data_count > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($country->country->appointments/$country->country->data_count * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($country->data_count > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                {{ number_format($country->appointments/$country->data_count * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($country->region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($country->region->appointments/$country->region->data_count * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif

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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-conversion"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Conversion') }}"],
                datasets: [

                    @if($country->country->appointments > 0)
                        {
                            label: "Country",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format(($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km)/$country->country->appointments * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($country->appointments > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                {{ number_format(($country->new + $country->used + $country->demo + $country->zero_km)/$country->appointments * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($country->region->appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km)/$country->region->appointments * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif

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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($country->manufacturer->name)) }}-bar-chart-breakdown"), {

            type: 'bar',

            data: {
                labels: ["{{ __('New') }}", "{{ __('Used') }}", "{{ __('Demo') }}", "{{ __('0km') }}", "{{ __('In Progress') }}"],
                datasets: [

                    @if($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($country->country->new/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->used/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->demo/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->zero_km/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($country->country->inprogress/($country->country->new + $country->country->used + $country->country->demo + $country->country->zero_km + $country->country->inprogress) * 100, 1, '.', ',')}}
                            ]
                        },
                    @endif

                    @if($country->data_count > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                @if($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress > 0)
                                    {{ number_format($country->new/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->used/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->demo/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->zero_km/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->inprogress/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        },
                    @endif

                    @if($country->region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                @if($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress > 0)
                                    {{ number_format($country->region->new/($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->region->used/($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->region->demo/($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->region->zero_km/($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($country->region->inprogress/($country->region->new + $country->region->used + $country->region->demo + $country->region->zero_km + $country->region->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        }
                    @endif

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


@endif

<script src="/js/select-reporting-level.js"></script>
<script src="/js/country-manufacturer-regions.js"></script> 
<script src="/js/manufacturer-country-dealerships.js"></script> 

@endsection