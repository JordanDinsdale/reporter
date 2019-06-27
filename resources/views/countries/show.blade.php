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

                    @if(count($groups) > 0)

                        <h2><a href="{{ route('groups') }}">Groups</a></h2>

                        <ul>

                            @foreach($groups as $group)

                                <li>

                                    <a href="{{ route('group', $group->id) }}">{{ $group->name }}</a>

                                    <ul>

                                        @foreach($group->dealerships as $dealership)

                                            <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                        @endforeach

                                    </ul>

                                </li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($country->users) > 0)

                        <h2><a href="{{ route('users') }}">Users</a></h2>

                        <ul>

                            @foreach($country->users as $user)

                                <li><a href="{{ route('user', $user->id) }}">{{ $user->firstname }} {{ $user->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($appointments) > 0)

                        <h2><a href="{{ route('appointments') }}">Appointments</a></h2>

                        <ul>

                            @foreach($appointments as $appointment)

                                <li><a href="{{ route('appointment', $appointment->id) }}">{{ $appointment->firstname }} {{ $appointment->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection