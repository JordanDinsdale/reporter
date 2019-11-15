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
                                                    @foreach($events as $regionEvent)
                                                        <li class="event-listing"><a href="{{ route('eventManufacturerRegionless',[$regionEvent->id,$manufacturer->id]) }}">{{ $regionEvent->name }}</a></li>
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

                                <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" selected >{{ $manufacturer->name }}</option>

                            </select>

                        </div>

                    </div>                    

                    <div id="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}">

                        <div class="row results cardc">

                            <p>{{ __('No information to display') }}</p>

                        </div>

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

@endsection