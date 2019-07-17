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

                    <h2><a href="{{ route('manufacturer', $manufacturer->id) }}">{{ $manufacturer->name }}</a> {{ $country->name }}</h2>

                    @if($manufacturer->company)

                        <p><a href="{{ route('company', $manufacturer->company->id) }}">{{ $manufacturer->company->name }}</a></p>

                    @endif

                    <h3>Add Region</h3>

                    <form method="post" action="{{ route('regionStore') }}">    
                        @csrf
                        <div class="form-group">    
                            <label for="region">Name</label>
                            <input type="text" class="form-control" name="region" />
                        </div>   
                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />
                        <input type="hidden" name="country_id" value="{{ $country->id }}" />
                        <button type="submit" class="btn btn-primary">Add Region</button>
                    </form>

                    <ul>

                        @foreach($manufacturer->countries as $region)

                            @if($region->id == $country->id)

                                <li>
                                    <a href="{{ route('region', $region->pivot->id) }}">{{ $region->pivot->name }}</a> | <a href="{{ route('regionEdit',$region->pivot->id) }}">Edit</a>
                                    <form action="{{ route('regionDestroy', $region->pivot->id)}}" method="post">
                                        @csrf
                                        <button type="submit">Delete</button>
                                    </form>
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

                                                            <li><a href="{{ route('event',$event->id) }}">{{ $event->name }}</a></li>

                                                        @endforeach

                                                    </ul>

                                                @endif

                                            @endif

                                        @endforeach

                                    </ul>

                                @endif

                            @endif

                        @endforeach

                        @if(isset($noregion))

                            @if(count($noregion) > 0)

                                <li><a href="{{ route('manufacturerRegionless', [$manufacturer->id,$country->id]) }}">No Region</a></li>

                                <ul>

                                    @foreach($noregion as $dealership)

                                        <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                        @if(count($dealership->events) > 0)

                                            <ul>

                                                @foreach($dealership->events as $event)

                                                    @foreach($event->manufacturers as $eventManufacturer)

                                                        @if($manufacturer->id == $eventManufacturer->id)

                                                            <li><a href="{{ route('event',$event->id) }}">{{ $event->name }}</a></li>

                                                        @endif

                                                    @endforeach

                                                @endforeach

                                            </ul>

                                        @endif

                                    @endforeach

                                </ul>

                            @endif

                        @endif

                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection