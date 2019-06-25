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

                    <h1>{{ $country->name }}</h1>

                    @if(count($country->dealerships) > 0)

                        <h2>Dealerships</h2>

                        <ul>

                            @foreach($country->dealerships as $dealership)

                                <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection