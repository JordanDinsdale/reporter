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

                    <h2>{{ $manufacturer->name }}</h2>

                    <p><a href="{{ route('company', $manufacturer->company->id) }}">{{ $manufacturer->company->name }}</a></p>

                    @if(count($manufacturer->countries->unique('name')) > 0)

                        <h3>Countries & Regions</h3>

                        @foreach($manufacturer->countries->unique('name') as $country)

                            <p>{{ $country->name }}</p>

                            <ul>

                                @foreach($manufacturer->countries as $region)

                                    @if($region->id == $country->id)

                                        <li>
                                            <a href="{{ route('region', $region->pivot->id) }}">{{ $region->pivot->name }}</a> | <a href="{{ route('regionEdit',$region->pivot->id) }}">Edit</a> |
                                            <form action="{{ route('regionDestroy', $region->pivot->id)}}" method="post">
                                                @csrf
                                                <button type="submit">Delete</button>
                                            </form>
                                        </li>

                                    @endif

                                @endforeach

                            </ul>

                        @endforeach

                    @endif

                    <h4>Add Region</h4>

                    <form method="post" action="{{ route('regionStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="region">Name</label>
                            <input type="text" class="form-control" name="region" required />
                        </div>
                        <div class="form-group">    
                            <label for="country_id">Country</label>
                            <select class="form-control" name="country_id" required />
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>     
                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />            
                        <button type="submit" class="btn btn-primary">Add Region</button>
                    </form>

                    @if($groups)

                        <h3>Groups</h3>

                        <ul>

                            @foreach($groups as $group)

                                <li><a href="{{ route('group', $group->id) }}">{{ $group->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($manufacturer->dealerships) > 0)

                        <h3>Dealerships</h3>

                        <ul>

                            @foreach($manufacturer->dealerships as $dealership)

                                <li><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a> @if($dealership->region)(<a href="{{ route('region', $dealership->region->id) }}">{{ $dealership->region->name }}</a>)@endif</li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($manufacturer->appointments) > 0)

                        <h3>Appointments</h3>

                        <ul>

                            @foreach($manufacturer->appointments as $appointment)

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