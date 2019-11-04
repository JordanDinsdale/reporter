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

                            Showing results for 

                            @switch($level)

                                @case('Company')
                                    Company | {{ $company->name }} | 
                                    @break

                                @case('Manufacturer')
                                    Manufacturer | {{ $company->manufacturer->name }} | 
                                    @break

                                @case('Country')
                                    Country | {{ $company->manufacturer->name }} {{ $company->country->name }} | 
                                    @break

                                @case('Region')
                                    Region | {{ $company->manufacturer->name }} {{ $company->region->country->name }} {{ $company->region->name }} | 
                                    @break

                                @case('Dealership')
                                    Dealership | {{ $company->dealership->name }} | 
                                    @break

                                @default
                                    Company | {{ $company->name }} | 

                            @endswitch

                            @if(\Carbon\Carbon::parse($company->start_date)->format('M') == \Carbon\Carbon::parse($company->end_date)->format('M'))

                                {{ \Carbon\Carbon::parse($company->start_date)->format('d') }}

                            @else

                                {{ \Carbon\Carbon::parse($company->start_date)->format('d M') }}

                                @if(\Carbon\Carbon::parse($company->start_date)->format('Y') !== \Carbon\Carbon::parse($company->end_date)->format('Y'))

                                    {{ \Carbon\Carbon::parse($company->start_date)->format('Y') }}

                                @endif

                            @endif

                                 - {{ \Carbon\Carbon::parse($company->end_date)->format('d M Y') }}

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
                                                    @foreach($events as $companyEvent)
                                                        <li class="event-listing"><a href="{{ route('eventCompany',[$companyEvent->id,$company->id]) }}">{{ $companyEvent->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>Report By Date</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('companyReportDates',$company->id) }}">

                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  From date" required />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  To date" required />
                                                        </div>

                                                        <div class="col-md-12">
                                                            <select id="levels" class="form-control" name="level" required>
                                                                <option value="">Select Level</option>
                                                                <option value="Company">{{ $company->name }}</option>
                                                                <option value="Manufacturer">Manufacturer</option>
                                                                <option value="Country">Country</option>
                                                                <option value="Region">Region</option>
                                                                <option value="Dealership">Dealership</option>
                                                            </select>
                                                        </div>

                                                        <div id="companyContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="company_id" id="companies">
                                                                <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                                            </select>
                                                        </div>

                                                        <div id="manufacturerContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="manufacturer_id" id="manufacturers">
                                                                <option value="">Select Manufacturer</option>
                                                                @foreach($company->manufacturers as $manufacturer)
                                                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div id="countryContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="country_id" id="countries">
                                                                <option value="">Select Country</option>
                                                                <option disabled="true" value="">No countries currently available</option>
                                                            </select>
                                                        </div>

                                                        <div id="regionContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="region_id" id="regions">
                                                                <option value="">Select Region</option>
                                                                <option disabled="true" value="">No regions currently available</option>
                                                            </select>
                                                        </div>

                                                        <div id="dealershipContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="dealership_id" id="dealerships">
                                                                <option value="">Select Dealership</option>
                                                                <option disabled="true" value="">No dealerships currently available</option>
                                                            </select>
                                                        </div>

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

                                @if($level == 'Dealership')

                                    @php($eventManufacturer_ids = [])
                                    
                                    @foreach($company->manufacturers as $manufacturer)
                                        @foreach($company->dealership->events as $event)
                                            @foreach($event->manufacturers as $eventManufacturer)
                                                @if($manufacturer->id == $eventManufacturer->id)
                                                    @if(!in_array($eventManufacturer->id,$eventManufacturer_ids))
                                                        @php($eventManufacturer_ids[] = $eventManufacturer->id)
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach

                                    @if((count($company->manufacturers) > 1 && $level !== 'Dealership') || ($level == 'Dealership' && count($eventManufacturer_ids) > 1))
                                        <div class="checkbox">
                                            <input id="all" type="radio" name="brand" checked />
                                            <label for="all">All</label>
                                        </div>                                    
                                    @endif

                                    @foreach($company->manufacturers as $manufacturer)
                                        @if(in_array($manufacturer->id,$eventManufacturer_ids))
                                            <div class="checkbox">
                                                <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($eventManufacturer_ids) == 1) checked @endif/>
                                                <label for="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">{{ $manufacturer->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                @else 

                                    @if(count($company->manufacturers) > 1)
                                        <div class="checkbox">
                                            <input id="all" type="radio" name="brand" checked />
                                            <label for="all">All</label>
                                        </div>
                                    @endif

                                    @foreach($company->manufacturers as $manufacturer)
                                        <div class="checkbox">
                                            <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($company->manufacturers) == 1) checked @endif/>
                                            <label for="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">{{ $manufacturer->name }}</label>
                                        </div>
                                    @endforeach

                                @endif

                            </form>

                        </div>

                    </div>

                </div>

                <div class="col-md-10 main-content">

                    <div class="row">

                        <div class="col-md-12 filter-mobile">

                            Filter results

                            <select name="brand-mobile">

                                @if(count($company->manufacturers) > 1)
                                    <option value="all" selected>All</option>
                                @endif

                                @foreach($company->manufacturers as $manufacturer)
                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($company->manufacturers) == 1) selected @endif>{{ $manufacturer->name }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    @if((count($company->manufacturers) > 1 && $level !== 'Dealership') || ($level == 'Dealership' && count($eventManufacturer_ids) > 1))

                        <div id="all">

                            <div class="row results cardc">

                                <div class="col-md-4 donut-1">

                                    <h3>Response Rate</h3>

                                    <canvas id="responseRate" class="responseRate" width="180" height="180"></canvas>

                                    <p>{{ $company->data_count }} Invites</p>

                                    <p>{{ $company->appointments }} Appointments</p>

                                    @if($company->data_count > 0)

                                        <p>{{ number_format($company->appointments/$company->data_count * 100, 1, '.', ',') }}%</p>

                                    @endif
                                    
                                </div>

                                <div class="col-md-4 donut-2">

                                    <h3>Conversion Rate</h3>

                                    <canvas id="conversionRate" class="conversionRate" width="180" height="180"></canvas>

                                    <p>{{ $company->appointments }} appointments</p>

                                    <p>{{ $company->new + $company->used + $company->demo + $company->zero_km }} Sales</p>

                                    @if($company->appointments > 0)

                                        <p>{{ number_format(($company->new + $company->used + $company->demo + $company->zero_km)/$company->appointments * 100, 1, '.', ',') }}%</p>

                                    @endif

                                </div>

                                <div class="col-md-4">

                                    <h3>Sales breakdown</h3>

                                    <canvas id="salesBreakdown" class="salesBreakdown" width="180" height="180"></canvas>

                                    <div class="camembert-slice-container">

                                        @if(number_format($company->new/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-1"></div>
                                                {{ number_format($company->new/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% New
                                            </div>
                                        @endif

                                        @if(number_format($company->used/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-2"></div>
                                                {{ number_format($company->used/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% Used
                                            </div>
                                        @endif

                                        @if(number_format($company->demo/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-3"></div>
                                                {{ number_format($company->demo/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% Demo
                                            </div>
                                        @endif

                                        @if(number_format($company->zero_km/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice">
                                                <div class="circle circle-4"></div>
                                                {{ number_format($company->zero_km/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% 0KM
                                            </div>
                                        @endif

                                        @if(number_format($company->inprogress/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',') > 0)
                                            <div class="camembert-slice final">
                                                <div class="circle circle-5"></div>
                                                {{ number_format($company->inprogress/($company->new + $company->used + $company->demo + $company->zero_km + $company->inprogress) * 100, 1, '.', ',')}}% In progress
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
                                                    {{ $company->data_count }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Appointments
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->appointments }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    New Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->new }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Used Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->used }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 table-content">
                                            <div class="data-line">
                                                <div class="data-type">
                                                    Demo Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->demo }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    0km Vehicles
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->zero_km }}
                                                </div>
                                            </div>
                                            <div class="data-line">
                                                <div class="data-type">
                                                    In Progress
                                                </div>
                                                <div class="data-count">
                                                    {{ $company->inprogress }}
                                                </div>
                                            </div>

                                        </div>

                                        @if($level == 'Company')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('companyReportDatesDownload', [$company->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                            </div>

                                        @elseif($level == 'Dealership')
                                            
                                            <div class="col-md-12 download-table-btn">
                                                <a href="{{ route('dealershipDownloadCompany', [$company->dealership->id,$company->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                            </div>

                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                    @foreach($company->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if($level == 'Dealership' && !in_array($manufacturer->id,$eventManufacturer_ids)) style="display:none;" @elseif($level == 'Dealership' && count($eventManufacturer_ids) > 1) style="display:none;" @elseif($level != 'Dealership' && count($company->manufacturers) > 1) style="display:none;" @endif>

                            @if($manufacturer->data_count > 0)

                                <div class="row results cardc">

                                    <div class="col-md-4 donut-1">
                                        <h3>Response Rate</h3>
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-responseRate" class="responseRate" width="180" height="180"></canvas>
                                        <p>{{ $manufacturer->data_count }} Invites</p>
                                        <p>{{ $manufacturer->appointments }} Appointments</p>

                                        @if($company->data_count > 0)

                                            <p>{{ number_format($company->appointments/$company->data_count * 100, 1, '.', ',') }}%</p>

                                        @endif

                                    </div>

                                    <div class="col-md-4 donut-2">
                                        <h3>Conversion Rate</h3>
                                        <canvas id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-conversionRate" class="conversionRate" width="180" height="180"></canvas>
                                        <p>{{ $manufacturer->appointments }} appointments</p>
                                        <p>{{ $manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km }} Sales</p>

                                        @if($company->appointments > 0)

                                            <p>{{ number_format(($company->new + $company->used + $company->demo + $company->zero_km)/$company->appointments * 100, 1, '.', ',') }}%</p>

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

                                @if($level == 'Region' || $level == 'Dealership')

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

                                @endif

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

                                            @if($level == 'Manufacturer')
                                            
                                                <div class="col-md-12 download-table-btn">
                                                    <a href="{{ route('manufacturerReportDatesDownload', [$manufacturer->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                                </div>

                                            @elseif($level == 'Country')
                                            
                                                <div class="col-md-12 download-table-btn">
                                                    <a href="{{ route('manufacturerCountryReportDatesDownload', [$manufacturer->id,$company->country->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                                </div>

                                            @elseif($level == 'Region')
                                            
                                                <div class="col-md-12 download-table-btn">
                                                    <a href="{{ route('regionDownload', [$company->region->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                                </div>

                                            @elseif($level == 'Dealership')
                                        
                                                <div class="col-md-12 download-table-btn">
                                                    <a href="{{ route('dealershipDownloadManufacturer', [$company->dealership->id,$manufacturer->id,$company->start_date,$company->end_date]) }}" class="btn btn-sm"><i class="fas fa-download"></i>DOWNLOAD AS CSV</a>
                                                </div>

                                            @endif

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
                {{ $company->appointments }}, 
                {{ $company->data_count - $company->appointments }}
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
                {{ $company->new + $company->used + $company->demo + $company->zero_km }}, 
                {{ $company->appointments - $company->new - $company->used - $company->demo - $company->zero_km }}
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
            @if($company->new > 0)"New",@endif 
            @if($company->used > 0)"Used",@endif 
            @if($company->demo > 0)"Demo",@endif 
            @if($company->zero_km > 0)"0km",@endif 
            @if($company->inprogress > 0)"In Progress"@endif 
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

@foreach($company->manufacturers as $manufacturer)

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


        @if($level == 'Region')


        <script type="text/javascript">

        new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-response"), {

            type: 'bar',

            data: {
                labels: ["Response"],
                datasets: [

                    @if($manufacturer->data_count > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format($manufacturer->appointments/$manufacturer->data_count * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($manufacturer->country->data_count > 0)
                        {
                            label: "Country",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($manufacturer->country->appointments/$manufacturer->country->data_count * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif

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

                    @if($manufacturer->appointments > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                {{ number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 1, '.', ',') }}
                            ]
                        }, 
                    @endif

                    @if($manufacturer->country->appointments > 0)
                        {
                            label: "Country",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format(($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km)/$manufacturer->country->appointments * 100, 1, '.', ',') }}
                            ]
                        }
                    @endif
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

                    @if($manufacturer->data_count > 0)
                        {
                            label: "Region",
                            backgroundColor: "#333C42",
                            data: [
                                @if($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress > 0)
                                    {{ number_format($manufacturer->new/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->used/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->demo/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->zero_km/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->inprogress/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}}
                                @endif
                            ]
                        }, 
                    @endif

                    @if($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress > 0)
                        {
                            label: "Country",
                            backgroundColor: "#6D497F",
                            data: [
                                {{ number_format($manufacturer->country->new/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->country->used/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->country->demo/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->country->zero_km/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                {{ number_format($manufacturer->country->inprogress/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}}
                            ]
                        }
                    @endif
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


        @elseif($level == 'Dealership')


            <script type="text/javascript">

            new Chart(document.getElementById("{{ str_replace(' ','-',strtolower($manufacturer->name)) }}-bar-chart-response"), {

                type: 'bar',

                data: {
                    labels: ["Response"],
                    datasets: [

                        @if($manufacturer->country->data_count > 0)
                            {
                                label: "Country",
                                backgroundColor: "#6D497F",
                                data: [
                                    {{ number_format($manufacturer->country->appointments/$manufacturer->country->data_count * 100, 1, '.', ',') }}
                                ]
                            },
                        @endif

                        @if($manufacturer->data_count > 0)
                            {
                                label: "Dealership",
                                backgroundColor: "#BA97CC",
                                data: [
                                    {{ number_format($manufacturer->appointments/$manufacturer->data_count * 100, 1, '.', ',') }}
                                ]
                            },
                        @endif

                        @if(isset($manufacturer->region))

                            @if($manufacturer->region->data_count > 0)
                                {
                                    label: "Region",
                                    backgroundColor: "#333C42",
                                    data: [
                                        {{ number_format($manufacturer->region->appointments/$manufacturer->region->data_count * 100, 1, '.', ',') }}
                                    ]
                                }
                            @endif

                        @endif

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

                        @if($manufacturer->country->appointments > 0)
                            {
                                label: "Country",
                                backgroundColor: "#6D497F",
                                data: [
                                    {{ number_format(($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km)/$manufacturer->country->appointments * 100, 1, '.', ',') }}
                                ]
                            },
                        @endif

                        @if($manufacturer->appointments > 0)
                            {
                                label: "Dealership",
                                backgroundColor: "#BA97CC",
                                data: [
                                    {{ number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 1, '.', ',') }}
                                ]
                            },
                        @endif

                        @if(isset($manufacturer->region))

                            @if($manufacturer->region->appointments > 0)
                                {
                                    label: "Region",
                                    backgroundColor: "#333C42",
                                    data: [
                                        {{ number_format(($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km)/$manufacturer->region->appointments * 100, 1, '.', ',') }}
                                    ]
                                }
                            @endif

                        @endif

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

                        @if($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress > 0)
                            {
                                label: "Country",
                                backgroundColor: "#6D497F",
                                data: [
                                    {{ number_format($manufacturer->country->new/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->country->used/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->country->demo/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->country->zero_km/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}},
                                    {{ number_format($manufacturer->country->inprogress/($manufacturer->country->new + $manufacturer->country->used + $manufacturer->country->demo + $manufacturer->country->zero_km + $manufacturer->country->inprogress) * 100, 1, '.', ',')}}
                                ]
                            },
                        @endif

                        @if($manufacturer->data_count > 0)
                            {
                                label: "Dealership",
                                backgroundColor: "#BA97CC",
                                data: [
                                    @if($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress > 0)
                                        {{ number_format($manufacturer->new/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                        {{ number_format($manufacturer->used/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                        {{ number_format($manufacturer->demo/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                        {{ number_format($manufacturer->zero_km/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}},
                                        {{ number_format($manufacturer->inprogress/($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km + $manufacturer->inprogress) * 100, 1, '.', ',')}}
                                    @endif
                                ]
                            },
                        @endif

                        @if(isset($manufacturer->region))

                            @if($manufacturer->region->data_count > 0)
                                {
                                    label: "Region",
                                    backgroundColor: "#333C42",
                                    data: [
                                        @if($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress > 0)
                                            {{ number_format($manufacturer->region->new/($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress) * 100, 1, '.', ',')}},
                                            {{ number_format($manufacturer->region->used/($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress) * 100, 1, '.', ',')}},
                                            {{ number_format($manufacturer->region->demo/($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress) * 100, 1, '.', ',')}},
                                            {{ number_format($manufacturer->region->zero_km/($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress) * 100, 1, '.', ',')}},
                                            {{ number_format($manufacturer->region->inprogress/($manufacturer->region->new + $manufacturer->region->used + $manufacturer->region->demo + $manufacturer->region->zero_km + $manufacturer->region->inprogress) * 100, 1, '.', ',')}}
                                        @endif
                                    ]
                                }
                            @endif

                        @endif

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


    @endif

@endforeach

<script src="/js/select-reporting-level.js"></script>
<script src="/js/manufacturer-countries.js"></script> 
<script src="/js/country-manufacturer-regions.js"></script> 
<script src="/js/company-countries.js"></script> 
<script src="/js/company-country-dealerships.js"></script> 

@endsection