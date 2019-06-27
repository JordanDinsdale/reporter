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

                    <h1>{{ $dealership->name }}</h1>

                    <h2><a href="{{ route('country', $dealership->country->id) }}">{{ $dealership->country->name }}</a></h2>
                    
                    <h3>Manufacturers</h3>

                    <h3>Add Manufacturer</h3>

                    <form method="post" action="{{ route('attachManufacturer') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="manufacturer_id">Manufacturer</label>
                            <select class="form-control" name="manufacturer_id" id="manufacturers" required/>
                                <option value="">Select Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id}}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div id="regionContainer" class="form-group d-none">    
                            <label for="region_id">Region</label>
                            <select class="form-control" name="region_id" id="regions"/>
                            </select>
                        </div>  
                        <input type="hidden" name="dealership_id" value="{{ $dealership->id }}" />           
                        <button type="submit" class="btn btn-primary">Add Manufacturer</button>
                    </form>

                    @if(count($dealership->manufacturers) > 0)
                        <ul>
                            @foreach($dealership->manufacturers as $manufacturer)
                                <li>

                                    @if($manufacturer->region)
                                        <a href="{{ route('manufacturer', $manufacturer->id) }}">{{ $manufacturer->name }}</a> <a href="{{ route('region', $manufacturer->region->id) }}">({{ $manufacturer->region->name }})</a>
                                    @else
                                        <a href="{{ route('manufacturer', $manufacturer->id) }}">{{ $manufacturer->name }}</a>
                                    @endif

                                    <form method="post" action="{{ route('detachManufacturer') }}">
                                        @csrf
                                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />     
                                        <input type="hidden" name="dealership_id" value="{{ $dealership->id }}" />           
                                        <button type="submit" class="btn btn-danger">Remove Manufacturer</button>
                                    </form>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(count($dealership->users) > 0)

                        <h3>Users</h3>

                        <ul>

                            @foreach($dealership->users as $user)

                                <li><a href="{{ route('user',$user->id )}}">{{ $user->firstname }} {{ $user->surname }}</a></li>

                                @if(count($user->appointments) > 0)

                                    <ul>

                                        @foreach($user->appointments as $appointment)

                                            <li><a href="{{ route('appointment',$appointment->id )}}">{{ $appointment->firstname }} {{ $appointment->surname }}</a></li>

                                        @endforeach

                                    </ul>

                                @endif

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

@section('scripts')

     <script src="/js/manufacturer-regions.js"></script> 

@endsection
