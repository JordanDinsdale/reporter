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

                    <h2>{{ $group->name }}</h2>

                    <h3>Add Dealership</h3>

                    <form method="post" action="{{ route('dealershipStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="dealership">Name</label>
                            <input type="text" class="form-control" name="dealership"/>
                        </div>  
                        <div class="form-group">    
                            <label for="country_id">Country</label>
                            <select class="form-control" name="country_id"/>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>   
                        <input type="hidden" name="group_id" value="{{ $group->id }}" />            
                        <button type="submit" class="btn btn-primary">Add Dealership</button>
                    </form>

                    @if(count($group->dealerships) > 0)

                        <h3>Dealerships</h3>

                        <ul>

                            @foreach($group->dealerships as $dealership)

                                <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if(count($appointments) > 0)

                        <h3>Appointments</h3>

                        <ul>

                            @foreach($appointments as $appointment)

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