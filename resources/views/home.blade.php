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

                    <p>Your user level is {{ $user->level }}</p>

                    @if(count($companies) > 0)

                        <h2><a href="{{ route('companies') }}">Companies</a></h2>

                        <ul>

                            @foreach($companies as $company)

                                <li>
                                    <a href="{{ route('company',$company->id) }}">{{ $company->name }}</a>
                                </li>

                                @if(count($company->manufacturers) > 0)

                                    <ul>

                                        @foreach($company->manufacturers as $manufacturer)

                                            <li>
                                                <a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a>
                                            </li>

                                            @if(count($manufacturer->countries) > 0)

                                                <ul>

                                                    @foreach($manufacturer->countries->unique('name') as $country)

                                                        <li>
                                                            <a href="{{ route('manufacturerCountry',[$manufacturer->id,$country->id]) }}">{{ $country->name }}</a>
                                                        </li>

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

                                                                <li>No Region</li>

                                                                <ul>

                                                                    @foreach($noregion as $dealership)

                                                                        <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                                                    @endforeach

                                                                </ul>

                                                            @endif

                                                        </ul>

                                                    @endforeach

                                                </ul>

                                            @endif

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if(count($manufacturers) > 0)

                        <h2><a href="{{ route('manufacturers') }}">Manufacturers</a></h2>

                        <ul>

                            @foreach($manufacturers as $manufacturer)

                                <li><a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a></li>

                                @if($manufacturer->countries)

                                    <ul>

                                        @foreach($manufacturer->countries->unique('name') as $country)

                                            <li><a href="{{ route('manufacturerCountry',[$manufacturer->id,$country->id]) }}">{{ $country->name }}</a></li>

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

                                                    <li>No Region</li>

                                                    <ul>

                                                        @foreach($noregion as $dealership)

                                                            <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                                        @endforeach

                                                    </ul>

                                                @endif

                                            </ul>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if(count($countries) > 0)

                        <h2><a href="{{ route('countries') }}">Countries</a></h2>

                        <ul>

                            @foreach($countries as $country)

                                <li><a href="{{ route('country',$country->id) }}">{{ $country->name }}</a></li>

                                @if(count($country->manufacturers) > 0)

                                    <ul>

                                        @foreach($country->manufacturers->unique('name') as $manufacturer)

                                            <li><a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a></li>

                                            <ul>
                                                
                                                @foreach($country->manufacturers as $region)

                                                    @if($region->id == $manufacturer->id)

                                                        <li>
                                                            <a href="{{ route('region', $region->pivot->id) }}">{{ $region->pivot->name }}</a>
                                                        </li>

                                                        @if(count($manufacturer->dealerships) > 0)

                                                            @php($noregion = [])

                                                            <ul>

                                                                @foreach($manufacturer->dealerships as $dealership)

                                                                    @if(!$dealership->pivot->region_id && $dealership->country_id == $country->id)

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

                                                    <li>No Region</li>

                                                    <ul>

                                                        @foreach($noregion as $dealership)

                                                            <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></li>

                                                        @endforeach

                                                    </ul>

                                                @endif

                                            </ul>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if(count($groups) > 0)

                        <h2><a href="{{ route('groups') }}">Groups</a></h2>

                        <ul>

                            @foreach($groups as $group)

                                <li><a href="{{ route('group', $group->id) }}">{{ $group->name }}</h3></li>

                                @if($group->dealerships)

                                    <ul>

                                        @foreach($group->dealerships as $dealership)

                                            <li>
                                                
                                                <a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a>
                                                <br />
                                                (<a href="{{ route('country', $dealership->country->id) }}">{{ $dealership->country->name }}</a>)
                                                <br />
                                                @if($dealership->manufacturers)

                                                    <ul>

                                                        @foreach($dealership->manufacturers as $manufacturer)
                                                            @if($manufacturer->region)
                                                                <li>
                                                                    <a href="{{ route('manufacturer', $manufacturer->id) }}">
                                                                    {{ $manufacturer->name }}</a>
                                                                    (<a href="{{ route('region', $manufacturer->region->id) }}">{{ $manufacturer->region->name }}</a>)
                                                                </li>
                                                            @else 
                                                                <li><a href="{{ route('manufacturer', $manufacturer->id) }}">
                                                                    {{ $manufacturer->name }}
                                                                </a></li>
                                                            @endif
                                                        @endforeach

                                                    </ul>

                                                @endif

                                            </li>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if(count($users) > 0)

                        <h2><a href="{{ route('users') }}">Users</a></h2>

                        <ul>

                            @foreach($users as $user)

                                <li><a href="{{ route('user',$user->id) }}">{{ $user->firstname }} {{ $user->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="/js/manufacturer-users.js"></script> 

@endsection