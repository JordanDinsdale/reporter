@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    <h1>{{ $company->name }}</h1>

                    @if(count($company->manufacturers) > 0)

                        <ul>

                            @foreach($company->manufacturers as $manufacturer)

                                <li>

                                    <a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a>

                                </li>

                                @if(count($manufacturer->countries) > 0)

                                    <ul>

                                        @foreach($manufacturer->countries->unique('name') as $country)

                                            <li>

                                                <a href="{{ route('manufacturerCountry',[$manufacturer->id,$country->id]) }}">{{ $country->name }}</a>

                                            </li>

                                            <ul>

                                                @foreach($manufacturer->countries as $region)

                                                    @if($region->id == $country->id)

                                                        <li>
                                                            <a href="{{ route('region', $region->pivot->id) }}">{{ $region->pivot->name }}</a>
                                                        </li>

                                                        @if(count($manufacturer->dealerships) > 0)

                                                            @php($noregion = [])

                                                            <ul>

                                                                @foreach($manufacturer->dealerships as $dealership)

                                                                    @if(!$dealership->pivot->region_id && $dealership->country_id == $region->id)

                                                                        @php($noregion[] = $dealership)

                                                                    @elseif($dealership->pivot->region_id == $region->pivot->id)

                                                                        <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                                                        @if(count($dealership->events) > 0)

                                                                            <ul>

                                                                                @foreach($dealership->events as $event)

                                                                                    @foreach($event->manufacturers as $eventManufacturer)

                                                                                        @if($eventManufacturer->id == $manufacturer->id)

                                                                                            <li><a href="{{ route('event', $event->id) }}">{{ $event->name }}</a></li>

                                                                                        @endif

                                                                                    @endforeach

                                                                                @endforeach

                                                                            </ul>

                                                                        @endif

                                                                    @endif

                                                                @endforeach

                                                            </ul>

                                                        @endif

                                                    @endif

                                                @endforeach

                                                @if(count($noregion) > 0)

                                                    <li><a href="{{ route('manufacturerRegionless', [$manufacturer->id,$country->id]) }}">No Region</a></li>

                                                    <ul>

                                                        @foreach($noregion as $dealership)

                                                            <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                                            @if(count($dealership->events) > 0)

                                                                <ul>

                                                                    @foreach($dealership->events as $event)

                                                                        @foreach($event->manufacturers as $eventManufacturer)

                                                                            @if($eventManufacturer->id == $manufacturer->id)

                                                                                <li><a href="{{ route('event', $event->id) }}">{{ $event->name }}</a></li>

                                                                            @endif

                                                                        @endforeach

                                                                    @endforeach

                                                                </ul>

                                                            @endif

                                                        @endforeach

                                                    </ul>

                                                @endif

                                            </ul>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection