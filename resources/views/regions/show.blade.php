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

                    <h1><a href="{{ route('manufacturer',$region->manufacturer->id) }}">{{ $region->manufacturer->name }}</a></h1>

                    <h2>{{ $region->name }}</h2>

                    @if(count($region->manufacturer->dealerships) > 0)

                        <h3>Dealerships</h3>

                        <ul>

                            @foreach($region->manufacturer->dealerships as $dealership)

                                @if($dealership->pivot->region_id == $region->id)

                                    <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if(count($region->appointments) > 0)

                        <h3>Appointments</h3>

                        <ul>

                            @foreach($region->appointments as $appointment)

                                    <li><a href="{{ route('appointment',$appointment->id) }}">{{ $appointment->firstname }} {{ $appointment->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection