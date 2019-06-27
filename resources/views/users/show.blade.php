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

                    <h2>{{ $user->firstname }} {{ $user->surname }}</h2>

                    <h3>{{ $user->level }}</h3>

                    <h4><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h4>

                    @if($user->dealership)

                        <h5><a href="{{ route('dealership',$user->dealership->id) }}">{{ $user->dealership->name }}</a></h5>

                    @endif

                    @if(count($user->appointments) > 0)

                        <h6>Appointments</h6>

                        <ul>

                            @foreach($user->appointments as $appointment)

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