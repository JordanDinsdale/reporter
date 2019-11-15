<div class="container nav-l1">

    <div class="logo">

        <a href="{{ route('home') }}"><img src="/images/logo.png" ></a>

    </div>

    <div class="nav-l1-items">

        <ul>

            <li>

                <form method="POST" action="{{ route('changelocale') }}" class="form-inline navbar-select">

                    {{ csrf_field() }}

                    <div class="form-group @if($errors->first('locale')) has-error @endif">
                        <i class="fas fa-globe"></i>
                        <select class="form-control" name="locale" id="locale" onchange="this.form.submit()" required>
                            <option value="en" @if(\App::getLocale() == 'en') selected @endif>EN</option>
                            <option value="fr" @if(\App::getLocale() == 'fr') selected @endif>FR</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('locale') }}</small>
                    </div>

                    <div class="btn-group pull-right sr-only">
                        <button type="submit" class="btn btn-success">{{ __('Change') }}</button>
                    </div>

                </form>

            </li>

            <li>

                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>{{ __('Log Out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>

        </ul>

    </div>

</div>

<div class="container nav-l2">

    <nav class="navbar navbar-expand-lg navbar-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                @if(Route::is('company','companyEvents','companyReports','companyReportDates','eventCompany'))

                    <li class="nav-item @if(Route::is('company')) active @endif">
                        <a class="nav-link first" href="{{ route('company',$company->id) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('companyEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('companyEvents',$company->id) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('companyReports','companyReportDates','eventCompany')) active @endif">
                        <a class="nav-link third" href="{{ route('companyReports',$company->id) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @elseif(Route::is('manufacturer','manufacturerEvents','manufacturerReports','manufacturerReportDates','eventManufacturer'))

                    <li class="nav-item @if(Route::is('manufacturer')) active @endif">
                        <a class="nav-link first" href="{{ route('manufacturer',$manufacturer->id) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('manufacturerEvents',$manufacturer->id) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerReports','manufacturerReportDates','eventManufacturer')) active @endif">
                        <a class="nav-link third" href="{{ route('manufacturerReports',$manufacturer->id) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @elseif(Route::is('manufacturerCountry','manufacturerCountryEvents','manufacturerCountryReports','manufacturerCountryReportDates','eventManufacturerCountry'))

                    <li class="nav-item @if(Route::is('manufacturerCountry')) active @endif">
                        <a class="nav-link first" href="{{ route('manufacturerCountry',[$country->manufacturer->id,$country->id]) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerCountryEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('manufacturerCountryEvents',[$country->manufacturer->id,$country->id]) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerCountryReports','manufacturerCountryReportDates','eventManufacturerCountry')) active @endif">
                        <a class="nav-link third" href="{{ route('manufacturerCountryReports',[$country->manufacturer->id,$country->id]) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @elseif(Route::is('region','regionEvents','regionReports','regionReportDates','eventManufacturerRegion'))

                    <li class="nav-item @if(Route::is('region')) active @endif">
                        <a class="nav-link first" href="{{ route('region',$region->id) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('regionEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('regionEvents',$region->id) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('regionReports','regionReportDates','eventManufacturerRegion')) active @endif">
                        <a class="nav-link third" href="{{ route('regionReports',$region->id) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @elseif(Route::is('manufacturerRegionless','manufacturerRegionlessEvents','manufacturerRegionlessReports','manufacturerRegionlessReportDates','eventManufacturerRegionless'))

                    <li class="nav-item @if(Route::is('manufacturerRegionless')) active @endif">
                        <a class="nav-link first" href="{{ route('manufacturerRegionless',[$manufacturer->id,$country->id]) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerRegionlessEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('manufacturerRegionlessEvents',[$manufacturer->id,$country->id]) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('manufacturerRegionlessReports','manufacturerRegionlessReportDates','eventManufacturerRegionless')) active @endif">
                        <a class="nav-link third" href="{{ route('manufacturerRegionlessReports',[$manufacturer->id,$country->id]) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @elseif(Route::is('dealership','dealershipEvents','dealershipReports','dealershipReportDates','event'))

                    <li class="nav-item @if(Route::is('dealership')) active @endif">
                        <a class="nav-link first" href="{{ route('dealership',$dealership->id) }}"><i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('dealershipEvents')) active @endif">
                        <a class="nav-link second" href="{{ route('dealershipEvents',$dealership->id) }}"><i class="fas fa-star"></i>{{ __('Events') }}</a>
                    </li>

                    <li class="nav-item @if(Route::is('dealershipReports','dealershipReportDates','event')) active @endif">
                        <a class="nav-link third" href="{{ route('dealershipReports',$dealership->id) }}"><i class="fas fa-chart-pie"></i>{{ __('Reports') }}</a>
                    </li>

                @endif
                
                <li class="nav-item">
                    <a class="nav-link third logout-mobile" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>{{ __('Log Out') }}</a>
                </li>

            </ul>

        </div>

    </nav>

</div>