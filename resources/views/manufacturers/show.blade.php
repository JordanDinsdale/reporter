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

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <h2>{{ $manufacturer->name }}</h2>

                    @if($manufacturer->company)

                        <p><a href="{{ route('company', $manufacturer->company->id) }}">{{ $manufacturer->company->name }}</a></p>

                    @endif

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

                                                                                            <li><a href="{{ route('eventManufacturer',[$event->id,$manufacturer->id]) }}">{{ $event->name }}</a></li>

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

                                                                                                    <li><a href="{{ route('eventManufacturer',[$event->id,$manufacturer->id]) }}">{{ $event->name }}</a></li>

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

                    <h4>Add Region</h4>

                    <form method="post" action="{{ route('regionStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="region">Name</label>
                            <input type="text" class="form-control" name="region" required />
                        </div>
                        <div class="form-group">    
                            <label for="country_id">Country</label>
                            <select class="form-control" name="country_id" required />
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>     
                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />            
                        <button type="submit" class="btn btn-primary">Add Region</button>
                    </form>

                    @if(count($groups) > 0)

                        <h3>Groups</h3>

                        <ul>

                            @foreach($groups as $group)

                                <li><a href="{{ route('group', $group->id) }}">{{ $group->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($manufacturer->dealerships) > 0)

                        <h3>Dealerships</h3>

                        <ul>

                            @foreach($manufacturer->dealerships as $dealership)

                                <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a> @if($dealership->region)(<a href="{{ route('region', $dealership->region->id) }}">{{ $dealership->region->name }}</a>)@endif</li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection