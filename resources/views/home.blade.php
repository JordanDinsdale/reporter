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

                    <p>Your user level is {{ $user->level }}</p>

                    @if($countries)

                        <h2><a href="{{ route('countries') }}">Countries</a></h2>

                        <ul>

                            @foreach($countries as $country)

                                <li><a href="{{ route('country',$country->id) }}">{{ $country->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if($manufacturers)

                        <h2><a href="{{ route('manufacturers') }}">Manufacturers</a></h2>

                        <ul>

                            @foreach($manufacturers as $manufacturer)

                                <li><a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a></li>

                                @if($manufacturer->regions)

                                    <ul>

                                        @foreach($manufacturer->regions as $region)

                                            <li><a href="{{ route('region',$region->id) }}">{{ $region->name }}</a></li>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if($groups)

                        <h2><a href="{{ route('groups') }}">Groups</a></h2>

                        <ul>

                            @foreach($groups as $group)

                                <li><h3><a href="{{ route('group', $group->id) }}">{{ $group->name }}</a></h3></li>

                                @if($group->dealerships)

                                    <ul>

                                        @foreach($group->dealerships as $dealership)

                                            <br />

                                            <li>
                                                
                                                <h4><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></h4>
                                                <h5><a href="{{ route('country', $dealership->country->id) }}">{{ $dealership->country->name }}</a></h5>

                                                @if($dealership->manufacturers)
                                                    @foreach($dealership->manufacturers as $manufacturer)
                                                        @if($manufacturer->region)
                                                            <p><a href="{{ route('region', $manufacturer->region->id) }}">
                                                                {{ $manufacturer->name }}
                                                                ({{ $manufacturer->region->name }})
                                                            </a></p>
                                                        @else 
                                                            <p><a href="{{ route('manufacturer', $manufacturer->id) }}">
                                                                {{ $manufacturer->name }}
                                                            </a></p>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </li>

                                            <br />

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
