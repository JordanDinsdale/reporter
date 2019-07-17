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

                    <h2><a href="{{ route('manufacturerCountry',[$region->manufacturer->id,$region->country->id]) }}">{{ $region->manufacturer->name }} {{ $region->country->name }}</a></h2>

                    <h3>{{ $region->name }}</h3>

                    <p><a href="{{ route('regionEdit',$region->id) }}">Edit</a></p>
                    

                    @if(count($region->manufacturer->dealerships) > 0)

                        <ul>

                            @foreach($region->manufacturer->dealerships as $dealership)

                                @if($dealership->pivot->region_id == $region->id)

                                    <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection