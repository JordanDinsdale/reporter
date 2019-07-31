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

                                @php($manufacturerCountries = [])

                                @if(count($manufacturer->countries) > 0)

                                    @foreach($manufacturer->countries->unique('name') as $country)

                                        @php($manufacturerCountries[] = $country)

                                    @endforeach

                                @endif

                                @if(count($manufacturer->dealerships) > 0)

                                    @foreach($manufacturer->dealerships->unique('country') as $dealership)

                                        @php($manufacturerCountries[] = $dealership->country)

                                    @endforeach

                                @endif

                                @if(count($manufacturerCountries) > 0)

                                    @php($country_ids = [])

                                    <ul>

                                        @foreach($countries as $country)

                                            @foreach($manufacturerCountries as $manufacturerCountry)

                                                @if($country->id == $manufacturerCountry->id)

                                                    @if(!in_array($country->id,$country_ids))

                                                        <li><a href="{{ route('manufacturerCountry',[$manufacturer->id,$country->id]) }}">{{ $country->name }}</li>

                                                        @if(count($country->regions) > 0)

                                                            <ul>

                                                                @foreach($country->regions as $region)

                                                                    @if($region->manufacturer->id == $manufacturer->id)

                                                                        <li><a href="{{ route('region',$region->id) }}">{{ $region->name }}</a></li>

                                                                        @if(count($region->dealerships) > 0)

                                                                            <ul>

                                                                                @foreach($region->dealerships as $dealership)

                                                                                    <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

                                                                                    @if(count($dealership->events) > 0)

                                                                                        <ul>

                                                                                            @foreach($dealership->events as $event)

                                                                                                @foreach($event->manufacturers as $eventManufacturer)

                                                                                                    @if($eventManufacturer->id == $manufacturer->id)

                                                                                                        <li><a href="{{ route('eventCompany',[$event->id,$company->id]) }}">{{ $event->name }}</a></li>

                                                                                                    @endif

                                                                                                @endforeach

                                                                                            @endforeach

                                                                                        </ul>

                                                                                    @endif

                                                                                @endforeach

                                                                            </ul>

                                                                        @endif

                                                                    @endif

                                                                @endforeach

                                                                @if(count($manufacturer->dealerships) > 0)

                                                                    @php($noregion = [])

                                                                    @foreach($manufacturer->dealerships->where('country_id',$country->id) as $dealership)

                                                                        @if(!$dealership->pivot->region_id && empty($noregion))

                                                                            <li><a href="{{ route('manufacturerRegionless',[$manufacturer->id,$country->id]) }}">No Region</a></li>

                                                                            @php($noregion[] = $dealership)

                                                                            <ul>

                                                                                @foreach($manufacturer->dealerships as $dealership)

                                                                                    @if(!$dealership->pivot->region_id)

                                                                                        @if($dealership->country->id == $country->id)

                                                                                            <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

                                                                                            @if(count($dealership->events) > 0)

                                                                                                <ul>

                                                                                                    @foreach($dealership->events as $event)

                                                                                                        @foreach($event->manufacturers as $eventManufacturer)

                                                                                                            @if($eventManufacturer->id == $manufacturer->id)

                                                                                                                <li><a href="{{ route('eventCompany',[$event->id,$company->id]) }}">{{ $event->name }}</a></li>

                                                                                                            @endif

                                                                                                        @endforeach

                                                                                                    @endforeach

                                                                                                </ul>

                                                                                            @endif

                                                                                        @endif

                                                                                    @endif

                                                                                @endforeach

                                                                            </ul>

                                                                        @endif

                                                                    @endforeach

                                                                @endif

                                                            </ul>

                                                        @endif

                                                    @endif

                                                    @php($country_ids[] = $country->id)

                                                @endif

                                            @endforeach

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