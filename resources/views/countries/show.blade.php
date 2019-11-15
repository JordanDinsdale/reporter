@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>{{ __($country->name) }}</h1>

                    @if(count($country->regions) > 0)

                        <h2><a href="{{ route('regions') }}">{{ __('Regions') }}</a></h2>

                        <ul>

                            @foreach($country->regions as $region)

                                <li>

                                    <a href="{{ route('region', $region->id) }}">{{ __($region->name) }}</a>

                                </li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($groups) > 0)

                        <h2><a href="{{ route('groups') }}">{{ __('Groups') }}</a></h2>

                        <ul>

                            @foreach($groups as $group)

                                <li>

                                    <a href="{{ route('group', $group->id) }}">{{ __($group->name) }}</a>

                                    <ul>

                                        @foreach($dealerships as $dealership)

                                            @if(isset($dealership->group) && $dealership->group->id == $group->id)

                                                <li><a href="{{ route('dealership', $dealership->id) }}">{{ __($dealership->name) }}</a></li>

                                            @endif

                                        @endforeach

                                    </ul>

                                </li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($users) > 0)

                        <h2><a href="{{ route('users') }}">{{ __('Users') }}</a></h2>

                        <ul>

                            @foreach($users as $user)

                                <li><a href="{{ route('user', $user->id) }}">{{ $user->firstname }} {{ $user->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection