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

                                @case('Region')
                                    {{ __('Region') }} | {{ $region->manufacturer->name }} {{ $region->country->name }} {{ $region->name }} | 
                                    @break

                                @case('Dealership')
                                    {{ __('Dealership') }} | {{ $region->dealership->name }} | 
                                    @break

                                @default
                                    {{ __('Region') }} | {{ $region->manufacturer->name }} {{ __($region->country->name) }} {{ $region->name }} |

                            @endswitch

                            @if(\Carbon\Carbon::parse($region->start_date)->format('M') == \Carbon\Carbon::parse($region->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($region->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($region->start_date)->format('d M') }}

                                @if(\Carbon\Carbon::parse($region->start_date)->format('Y') !== \Carbon\Carbon::parse($region->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($region->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($region->end_date)->format('d M Y') }}

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
                                                    @foreach($region->events as $regionEvent)
                                                        <li class="event-listing"><a href="{{ route('eventManufacturerRegion',[$regionEvent->id,$region->manufacturer->id]) }}">{{ $regionEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>{{ __('Report By Date') }}</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('regionReportDates', [$region->id]) }}">

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
                                                                <option value="Region">{{ $region->name }}</option>
                                                                <option value="Dealership">{{ __('Dealership') }}</option>
                                                            </select>
                                                        </div>

                                                        <select class="form-control d-none" name="manufacturer_id" id="manufacturers">
                                                            <option value="{{ $region->manufacturer->id }}" selected>{{ $region->manufacturer->name }}</option>
                                                        </select>
                                                        
                                                        <select class="form-control d-none" name="country_id" id="countries">
                                                            <option value="{{ $region->country->id }}" selected>{{ __($region->country->name) }}</option>
                                                        </select>

                                                        <select class="form-control d-none" name="region_id" id="regions">
                                                            <option value="{{ $region->id }}" selected>{{ $region->name }}</option>
                                                        </select>

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

                                <option value="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}" selected>{{ $region->manufacturer->name }}</option>

                            </select>

                        </div>

                    </div>

                    <div id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}">

                        @if($region->data_count > 0)

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">
                                    <h3>{{ __('Response Rate') }}</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                    <p>{{ $region->data_count }} {{ __('Invites') }}</p>
                                    <p>{{ $region->appointments }} {{ __('Appointments') }}</p>

                                    @if($region->data_count > 0)

                                        <p>{{ number_format($region->appointments/$region->data_count * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4 donut-2">
                                    <h3>{{ __('Conversion Rate') }}</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    <p>{{ $region->appointments }} {{ __('Appointments') }}</p>
                                    <p>{{ $region->new + $region->used + $region->demo + $region->zero_km }} {{ __('Sales') }}</p>

                                    @if($region->appointments > 0)

                                        <p>{{ number_format(($region->new + $region->used + $region->demo + $region->zero_km)/$region->appointments * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4">
                                    <h3>{{ __('Sales Breakdown') }}</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                    <div class="camembert-slice-container">

                                        @if(number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-1">
                                                </div>
                                                {{ number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') }}% {{ __('New') }}
                                            </div>
                                        @endif

                                        @if(number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-2">
                                                </div>
                                                {{ number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') }}% {{ __('Used') }}
                                            </div>
                                        @endif

                                        @if(number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-3">
                                                </div>
                                                {{ number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') }}% {{ __('Demo') }}
                                            </div>
                                        @endif

                                        @if(number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-4">
                                                </div>
                                                {{ number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') }}% {{ __('0km') }}
                                            </div>
                                        @endif

                                        @if(number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice final">
                                                <div class="circle circle-5">
                                                </div>
                                                {{ number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',') }}% {{ __('In Progress') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <div class="row results cardc">

                                <div class="col-md-12 bar-chart">
                                    <div>
                                        <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-response" width="800" height="450"></canvas>
                                    </div>
                                </div>

                            </div>

                            <div class="row results cardc">

                                <div class="col-md-12 bar-chart">
                                    <div>
                                        <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-conversion" width="800" height="450"></canvas>
                                    </div>
                                </div>

                            </div>

                            <div class="row results cardc">

                                <div class="col-md-12 bar-chart-2">
                                    <canvas id="{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-breakdown" width="800" height="450"></canvas>
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
                                                    {{ $region->data_count }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Appointments') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->appointments }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('New Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->new }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Used Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->used }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 table-content">
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Demo Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->demo }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('0km Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->zero_km }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('In Progress') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $region->inprogress }}
                                                </div>
                                            </div>

                                        </div>

                                        @if($level == 'Region')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('regionDownload', [$region->id,$region->start_date,$region->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                            </div>

                                        @elseif($level == 'Dealership')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('dealershipDownloadManufacturer', [$region->dealership->id,$region->manufacturer->id,$region->start_date,$region->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
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


@if($region->data_count > 0)


    <script type="text/javascript">

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-responseRate').getContext('2d');
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

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-conversionRate').getContext('2d');
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

    var ctx = document.getElementById('{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-salesBreakdown').getContext('2d');
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
                @if($region->new > 0)"{{ __('New') }}",@endif 
                @if($region->used > 0)"{{ __('Used') }}",@endif 
                @if($region->demo > 0)"{{ __('Demo') }}",@endif 
                @if($region->zero_km > 0)"{{ __('0km') }}",@endif 
                @if($region->inprogress > 0)"{{ __('In Progress') }}"@endif 
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Response') }}"],
                datasets: [

                    @if($region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($region->appointments/$region->data_count * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($region->country->data_count > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($region->country->appointments/$region->country->data_count * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif

                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Response Rate') }} %"
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-conversion"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Conversion') }}"],
                datasets: [

                    @if($region->appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($region->new + $region->used + $region->demo + $region->zero_km)/$region->appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($region->country->appointments > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format(($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km)/$region->country->appointments * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif
                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Conversion Rate') }} %"
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-breakdown"), {

            type: 'bar',

            data: {
                labels: ["{{ __('New') }}", "{{ __('Used') }}", "{{ __('Demo') }}", "{{ __('0km') }}", "{{ __('In Progress') }}"],
                datasets: [

                    @if($region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                @if($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress > 0)
                                    {{ number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        }, 
                    @endif

                    @if($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($region->country->new/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->used/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->demo/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->zero_km/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->inprogress/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}}
                            ]
                        }
                    @endif
                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Sales Breakdown') }} %"
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Response') }}"],
                datasets: [

                    @if($region->country->data_count > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($region->country->appointments/$region->country->data_count * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($region->data_count > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                {{ number_format($region->appointments/$region->data_count * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($region->region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($region->region->appointments/$region->region->data_count * 100, 1, '.', ',') }}
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-conversion"), {

            type: 'bar',

            data: {
                labels: ["{{ __('Conversion') }}"],
                datasets: [

                    @if($region->country->appointments > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format(($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km)/$region->country->appointments * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($region->appointments > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                {{ number_format(($region->new + $region->used + $region->demo + $region->zero_km)/$region->appointments * 100, 1, '.', ',') }}
                            ]
                        },
                    @endif

                    @if($region->region->appointments > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km)/$region->region->appointments * 100, 1, '.', ',') }}
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

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($region->manufacturer->name)) }}-bar-chart-breakdown"), {

            type: 'bar',

            data: {
                labels: ["{{ __('New') }}", "{{ __('Used') }}", "{{ __('Demo') }}", "{{ __('0km') }}", "{{ __('In Progress') }}"],
                datasets: [

                    @if($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress > 0)
                        {
                            label: "{{ __('Country') }}",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($region->country->new/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->used/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->demo/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->zero_km/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($region->country->inprogress/($region->country->new + $region->country->used + $region->country->demo + $region->country->zero_km + $region->country->inprogress) * 100, 1, '.', ',')}}
                            ]
                        },
                    @endif

                    @if($region->data_count > 0)
                        {
                            label: "{{ __('Dealership') }}",
                            backgroundColor: "#BA97CC",
                            data: [
                                @if($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress > 0)
                                    {{ number_format($region->new/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->used/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->demo/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->zero_km/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->inprogress/($region->new + $region->used + $region->demo + $region->zero_km + $region->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        },
                    @endif

                    @if($region->region->data_count > 0)
                        {
                            label: "{{ __('Region') }}",
                            backgroundColor: "#333C42",
                            data: [
                                @if($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress > 0)
                                    {{ number_format($region->region->new/($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->region->used/($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->region->demo/($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->region->zero_km/($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($region->region->inprogress/($region->region->new + $region->region->used + $region->region->demo + $region->region->zero_km + $region->region->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        }
                    @endif

                ]
            },

            options: {
                title: {
                    display: true,
                    text: "{{ __('Sales Breakdown') }} %"
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
<script src="/js/region-dealerships.js"></script> 

@endsection