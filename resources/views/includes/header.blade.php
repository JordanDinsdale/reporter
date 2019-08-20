<div class="container nav-l1">

    <div class="logo">

        <a href="{{ route('home') }}"><img src="/images/logo.png" ></a>

    </div>

    <div class="nav-l1-items">

        <ul>

            <li><a href="#" class="language"><i class="fas fa-globe"></i>ENG</a></li>

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

                @if(isset($region))

                    <li class="nav-item active">
                        <a class="nav-link first" href="{{ route('region',$region->id) }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link second" href="{{ route('regionEvents',$region->id) }}"><i class="fas fa-star"></i>Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link third" href="{{ route('regionReports',$region->id) }}"><i class="fas fa-star"></i>Reports</a>
                    </li>

                @elseif(isset($dealership))

                    <li class="nav-item active">
                        <a class="nav-link first" href="{{ route('dealership',$dealership->id) }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link second" href="{{ route('dealershipEvents',$dealership->id) }}"><i class="fas fa-star"></i>Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link third" href="{{ route('dealershipReports',$dealership->id) }}"><i class="fas fa-chart-pie"></i>Your Reports</a>
                    </li>

                @elseif(isset($event))

                    <li class="nav-item active">
                        <a class="nav-link first" href="{{ route('dealership',$event->dealership->id) }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link second" href="{{ route('dealershipEvents',$event->dealership->id) }}"><i class="fas fa-star"></i>Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link third" href="{{ route('dealershipReports',$event->dealership->id) }}"><i class="fas fa-chart-pie"></i>Your Reports</a>
                    </li>

                @endif
                
                <li class="nav-item">
                    <a class="nav-link third logout-mobile" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>{{ __('Log Out') }}</a>
                </li>

            </ul>

        </div>

    </nav>

</div>