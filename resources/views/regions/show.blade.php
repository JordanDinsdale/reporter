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

                    <h1>{{ $region->manufacturer->name }}</h1>

                    <h2>{{ $region->name }}</h2>

                    @if($region->manufacturer->dealerships)

                        <ul>

                            @foreach($region->manufacturer->dealerships as $dealership)

                                @if($dealership->pivot->region_id == $region->id)

                                    <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</li>

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