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

                    @if($manufacturers)

                        <h2>Manufacturers</h2>

                        <ul>

                            @foreach($manufacturers as $manufacturer)

                                <li>{{ $manufacturer->name }}</li>

                                @if($manufacturer->regions)

                                    <ul>

                                        @foreach($manufacturer->regions as $region)

                                            <li>{{ $region->name }}</li>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if($groups)

                        <h2>Groups</h2>

                        <ul>

                            @foreach($groups as $group)

                                <li>{{ $group->name }}</li>

                                @if($group->dealerships)

                                    <ul>

                                        @foreach($group->dealerships as $dealership)

                                            <br />

                                            <li>
                                                
                                                {{ $dealership->name }}<br />
                                                {{ $dealership->country }}<br />

                                                @if($dealership->manufacturers)
                                                    @foreach($dealership->manufacturers as $manufacturer)
                                                        {{ $manufacturer->name }} - {{ $manufacturer->region->name }}
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
