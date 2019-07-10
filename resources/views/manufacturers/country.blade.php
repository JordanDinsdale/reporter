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

                    <p><a href="{{ route('company', $manufacturer->company->id) }}">{{ $manufacturer->company->name }}</a></p>

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

                                @endforeach

                            </ul>

                        @endif

                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection