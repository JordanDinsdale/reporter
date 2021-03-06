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

                            {{ __('Showing results for No Region') }} | {{ $country->name }} | 

                            @if(\Carbon\Carbon::parse($events->start_date)->format('M') == \Carbon\Carbon::parse($events->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($events->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($events->start_date)->format('d M') }}

                                @if(\Carbon\Carbon::parse($events->start_date)->format('Y') !== \Carbon\Carbon::parse($events->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($events->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($events->end_date)->format('d M Y') }}

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
                                                    @foreach($events as $event)
                                                        <li class="event-listing"><a href="{{ route('eventManufacturerRegionless',[$event->id,$manufacturer->id]) }}">{{ $event->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>{{ __('Report By Date') }}</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('manufacturerRegionlessReportDates',[$manufacturer->id,$country->id]) }}">

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

                <div class="col-md-12 main-content">

                    <div class="row">

                        <div class="col-md-12 filter-mobile">

                            {{ __('Filter Results') }}

                            <select name="brand-mobile">

                                <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" selected>{{ $manufacturer->name }}</option>

                            </select>

                        </div>

                    </div>

                    <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">

                        @if($events->data_count > 0)

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">
                                    <h3>{{ __('Response Rate') }}</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                    <p>{{ $events->data_count }} {{ __('Invites') }}</p>
                                    <p>{{ $events->appointments }} {{ __('Appointments') }}</p>

                                    @if($events->data_count > 0)

                                        <p>{{ number_format($events->appointments/$events->data_count * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4 donut-2">
                                    <h3>Conversion Rate</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                    <p>{{ $events->appointments }} {{ __('Appointments') }}</p>
                                    <p>{{ $events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress }} {{ __('Sales') }}</p>

                                    @if($events->appointments > 0)

                                        <p>{{ number_format(($events->new + $events->used + $events->demo + $events->zero_km)/$events->appointments * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4">
                                    <h3>Sales breakdown</h3>
                                    <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>
                                    <div class="camembert-slice-container">

                                        @if(number_format($events->new/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-1">
                                                </div>
                                                {{ number_format($events->new/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') }}% {{ __('New') }}
                                            </div>
                                        @endif

                                        @if(number_format($events->used/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-2">
                                                </div>
                                                {{ number_format($events->used/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') }}% {{ __('Used') }}
                                            </div>
                                        @endif

                                        @if(number_format($events->demo/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-3">
                                                </div>
                                                {{ number_format($events->demo/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') }}% {{ __('Demo') }}
                                            </div>
                                        @endif

                                        @if(number_format($events->zero_km/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-4">
                                                </div>
                                                {{ number_format($events->zero_km/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') }}% {{ __('0km') }}
                                            </div>
                                        @endif

                                        @if(number_format($events->inprogress/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice final">
                                                <div class="circle circle-5">
                                                </div>
                                                {{ number_format($events->inprogress/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',') }}% {{ __('In Progress') }}
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
                                                    {{ $events->data_count }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Appointments') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->appointments }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('New Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->new }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Used Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->used }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 table-content">
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('Demo Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->demo }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('0km Vehicles') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->zero_km }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    {{ __('In Progress') }}
                                                </div>
                                                <div class="data-count">
                                                    {{ $events->inprogress }}
                                                </div>
                                            </div>

                                        </div>
                                            
                                        <div class="col-md-12 download-table-btn">
                                            <a href="{{ route('manufacturerRegionlessReportDatesDownload', [$manufacturer->id,$country->id,$events->start_date,$events->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>{{ __('DOWNLOAD AS CSV') }}</a>
                                        </div>

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


@if($events->data_count > 0)

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
                    {{ $events->appointments }}, 
                    {{ $events->data_count - $events->appointments }}
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
                    {{ $events->new + $events->used + $events->demo + $events->zero_km }}, 
                    {{ $events->appointments - $events->new - $events->used - $events->demo - $events->zero_km }}
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
                    @if($events->new > 0)"#304651",@endif 
                    @if($events->used > 0)"#262E33",@endif 
                    @if($events->demo > 0)"#CDDEEA",@endif 
                    @if($events->zero_km > 0)"#667681",@endif 
                    @if($events->inprogress > 0)"#8A9FAD"@endif 
                ],
                data: [
                    @if($events->new > 0){{ $events->new }},@endif 
                    @if($events->used > 0){{ $events->used }},@endif 
                    @if($events->demo > 0){{ $events->demo }},@endif 
                    @if($events->zero_km > 0){{ $events->zero_km }},@endif 
                    @if($events->inprogress > 0){{ $events->inprogress }}@endif
                ]
            }],
            labels: [
                @if($events->new > 0)"{{ __('New') }}",@endif 
                @if($events->used > 0)"{{ __('Used') }}",@endif 
                @if($events->demo > 0)"{{ __('Demo') }}",@endif 
                @if($events->zero_km > 0)"{{ __('0km') }}",@endif 
                @if($events->inprogress > 0)"{{ __('In Progress') }}"@endif 
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

                @if($events->appointments > 0)
                    {
                        label: "{{ __('Region') }}",
                        backgroundColor: "#333C42",
                        data: [
                            {{ number_format($events->appointments/$events->data_count * 100, 1, '.', ',') }}
                        ]
                    }, 
                @endif

                {
                    label: "{{ __('Country') }}",
                    backgroundColor: "#6D497F",
                    data: [
                        {{ number_format($country->appointments/$country->data_count * 100, 1, '.', ',') }}
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

                @if($events->appointments > 0)
                    {
                        label: "{{ __('Region') }}",
                        backgroundColor: "#333C42",
                        data: [
                            {{ number_format(($events->new + $events->used + $events->demo + $events->zero_km)/$events->appointments * 100, 1, '.', ',') }}
                        ]
                    }, 
                @endif

                {
                    label: "{{ __('Country') }}",
                    backgroundColor: "#6D497F",
                    data: [
                        {{ number_format(($country->new + $country->used + $country->demo + $country->zero_km)/$country->appointments * 100, 1, '.', ',') }}
                    ]
                }
            ]
        },

        options: {
            title: {
                display: true,
                text: "{{ __('Conversion Rate %') }}
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
                @if($events->data_count > 0)
                {
                    label: "{{ __('Region') }}",
                    backgroundColor: "#333C42",
                    data: [
                        @if($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress > 0)
                            {{ number_format($events->new/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($events->used/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($events->demo/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($events->zero_km/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',')}},
                            {{ number_format($events->inprogress/($events->new + $events->used + $events->demo + $events->zero_km + $events->inprogress) * 100, 1, '.', ',')}}
                        @endif
                    ]
                }, 
                @endif
                {
                    label: "{{ __('Country') }}",
                    backgroundColor: "#6D497F",
                    data: [
                        {{ number_format($country->new/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                        {{ number_format($country->used/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                        {{ number_format($country->demo/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                        {{ number_format($country->zero_km/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}},
                        {{ number_format($country->inprogress/($country->new + $country->used + $country->demo + $country->zero_km + $country->inprogress) * 100, 1, '.', ',')}}
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

@endsection