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

                            {{ __('Please select the results you would like to display') }}

                        </div>

                        <button id="hideBtn" class="open-button btn" onclick="openForm()" style="display: none;">{{ __('Choose Report') }}</button>
                        
                        <button id="cancel" type="button" class="cancel" onclick="closeForm()"><i class="fas fa-times"></i></button>

                        <div class="clear"></div>

                    </div>

                    <div class="report-dropdown" style="display:block;">

                        <div class="form-popup" id="reportForm">

                            <div class="container-fluid report-menu-inner">

                                <div class="container">

                                    <div class="row">

                                        <div class="col-md-5" >

                                            <h4>{{ __('Report By Event') }}</h4>

                                            <div class="event-list-container">
                                                <ul>
                                                    @foreach($events as $companyEvent)
                                                        <li class="event-listing"><a href="{{ route('eventCompany',[$companyEvent->id,$company->id]) }}">{{ __($companyEvent->name) }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-md-7">

                                            <h4>{{ __('Report By Date') }}</h4>

                                            <div class="date-picker-form">

                                                <form method="post" action="{{ route('companyReportDates', [$company->id]) }}">

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
                                                                <option value="Company">{{ __($company->name) }}</option>
                                                                <option value="Manufacturer">{{ __('Manufacturer') }}</option>
                                                                <option value="Country">{{ __('Country') }}</option>
                                                                <option value="Region">{{ __('Region') }}</option>
                                                                <option value="Dealership">{{ __('Dealership') }}</option>
                                                            </select>
                                                        </div>

                                                        <div id="companyContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="company_id" id="companies">
                                                                <option value="{{ $company->id }}" selected>{{ __($company->name) }}</option>
                                                            </select>
                                                        </div>

                                                        <div id="manufacturerContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="manufacturer_id" id="manufacturers">
                                                                <option value="">{{ __('Select Manufacturer') }}</option>
                                                                @foreach($company->manufacturers as $manufacturer)
                                                                    <option value="{{ $manufacturer->id }}">{{ __($manufacturer->name) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div id="countryContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="country_id" id="countries">
                                                                <option value="">{{ __('Select Country') }}</option>
                                                                <option disabled="true" value="">{{ __('No countries currently available') }}</option>
                                                            </select>
                                                        </div>

                                                        <div id="regionContainer" class="col-md-12 d-none">
                                                            <select class="form-control" name="region_id" id="regions">
                                                                <option value="">{{ __('Select Region') }}</option>
                                                                <option disabled="true" value="">{{ __('No regions currently available') }}</option>
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

    <div id="main-content-container" class="container-fluid bg-custom" style="opacity:0.5;">

        <div class="container main-content-container">

            <div class="row">

                <div class="col-md-2 sidebar">

                    <div class="sidebar-inner">

                        <h3>{{ __('Filter Results') }}</h3>

                        <div class="filter-group">

                            <h4>{{ __('Brands') }}</h4>

                            <form id="brandSelect">

                                @if(count($company->manufacturers) > 1)
                                    <div class="checkbox">
                                        <input id="all" type="radio" name="brand" checked />
                                        <label for="all">{{ __('All') }}</label>
                                    </div>
                                @endif

                                @foreach($company->manufacturers as $manufacturer)
                                    <div class="checkbox">
                                        <input id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" type="radio" name="brand"  @if(count($company->manufacturers) == 1) checked @endif/>
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

                            {{ __('Filter Results') }}

                            <select name="brand-mobile">

                                @if(count($company->manufacturers) > 1)
                                    <option value="all" selected>{{ __('All') }}</option>
                                @endif

                                @foreach($company->manufacturers as $manufacturer)
                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($company->manufacturers) == 1) selected @endif>{{ __($manufacturer->name) }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>    

                    @if(count($company->manufacturers) > 1)                

                        <div id="all">  

                            <div class="row results cardc">   

                                <p>{{ __('No information to display') }}</p>

                            </div>

                        </div>

                    @endif

                    @foreach($company->manufacturers as $manufacturer)

                        <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(count($company->manufacturers) > 1) style="display:none; @endif">

                            <div class="row results cardc">

                                <p>{{ __('No information to display') }}</p>

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