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

                                <li><a href="{{ route('dealership',$dealership->id) }}">{{ $dealership->name }}</a> | <a href="{{ route('dealershipEdit',$dealership->id) }}">Edit</a> |
                                <form action="{{ route('dealershipDestroy', $dealership->id)}}" method="post">
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form></li>

                                @if(count($dealership->events) > 0)

                                    <ul>

                                        @foreach($dealership->events as $event)

                                            <li><a href="{{ route('event',$event->id) }}">{{ $event->name }}</a></li>

                                        @endforeach

                                    </ul>

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