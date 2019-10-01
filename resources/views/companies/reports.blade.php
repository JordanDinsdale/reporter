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

                            Please select the results you would like to display

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

                                                <form method="post" action="{{ route('companyReportDates', [$company->id]) }}">

                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="start_date" placeholder="&#xF073;  From date" />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <input type='text' class='datepicker-here' data-language='en' name="end_date" placeholder="&#xF073;  To date" />
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

                    @if(count($company->manufacturers) > 1)                

                        <div id="all">  

                            <div class="row results cardc">   

                                <p>No information to display</p>

                            </div>

                        </div>

                    @endif

                    @foreach($company->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($company->manufacturers) > 1) style="display:none; @endif">

                            <div class="row results cardc">

                                <p>No information to display</p>

                            </div>

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

<script src="/js/select-reporting-level.js"></script>
<script src="/js/manufacturer-countries.js"></script> 
<script src="/js/country-manufacturer-regions.js"></script> 
<script src="/js/company-countries.js"></script> 
<script src="/js/company-country-dealerships.js"></script> 

@endsection