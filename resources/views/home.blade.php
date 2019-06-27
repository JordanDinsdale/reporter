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

                    <h2><a href="{{ route('appointments') }}">Appointments</a></h2>

                    <h3>Add Appointment</h3>

                    <form method="post" action="{{ route('appointmentStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="firstname" required/>
                        </div>   
                        <div class="form-group">    
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" name="surname" required/>
                        </div>          
                        <div class="form-group">    
                            <label for="manufacturer_id">Manufacturer</label>
                            <select class="form-control" name="manufacturer_id" id="manufacturers" required/>
                                <option value="">Choose Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id}}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <!--
                        <div class="form-group">    
                            <label for="sale">Sale Type</label>
                            <select class="form-control" name="sale" />
                                <option value="">Select Sale Type</option>
                                <option value="New">New</option>
                                <option value="Used">Used</option>
                                <option value="0km">0km</option>
                                <option value="Demo">Demo</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                        </div> 
                        -->
                        <div class="form-group">    
                            <label for="sales_executive_id">Sales Executive</label>
                            <select class="form-control" name="sales_executive_id" id="users" required/>
                                <option value="">Select Sales Executive</option>
                                @foreach($sales_executives as $sales_executive)
                                    <option value="{{ $sales_executive->id}}">{{ $sales_executive->firstname }} {{ $sales_executive->surname }}</option>
                                @endforeach
                            </select>
                        </div>            
                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </form>

                    @if($users)

                        <h2><a href="{{ route('users') }}">Users</a></h2>

                        <ul>

                            @foreach($users as $user)

                                <li><a href="{{ route('user',$user->id) }}">{{ $user->firstname }} {{ $user->surname }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if($countries)

                        <h2><a href="{{ route('countries') }}">Countries</a></h2>

                        <ul>

                            @foreach($countries as $country)

                                <li><a href="{{ route('country',$country->id) }}">{{ $country->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    @if($manufacturers)

                        <h2><a href="{{ route('manufacturers') }}">Manufacturers</a></h2>

                        <ul>

                            @foreach($manufacturers as $manufacturer)

                                <li><a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a></li>

                                @if($manufacturer->regions)

                                    <ul>

                                        @foreach($manufacturer->regions as $region)

                                            <li><a href="{{ route('region',$region->id) }}">{{ $region->name }}</a></li>

                                        @endforeach

                                    </ul>

                                @endif

                            @endforeach

                        </ul>

                    @endif

                    @if($groups)

                        <h2><a href="{{ route('groups') }}">Groups</a></h2>

                        <ul>

                            @foreach($groups as $group)

                                <li><h3><a href="{{ route('group', $group->id) }}">{{ $group->name }}</a></h3></li>

                                @if($group->dealerships)

                                    <ul>

                                        @foreach($group->dealerships as $dealership)

                                            <br />

                                            <li>
                                                
                                                <h4><a href="{{ route('dealership', $dealership->id) }}">{{ $dealership->name }}</a></h4>
                                                <h5><a href="{{ route('country', $dealership->country->id) }}">{{ $dealership->country->name }}</a></h5>

                                                @if($dealership->manufacturers)
                                                    @foreach($dealership->manufacturers as $manufacturer)
                                                        @if($manufacturer->region)
                                                            <p><a href="{{ route('region', $manufacturer->region->id) }}">
                                                                {{ $manufacturer->name }}
                                                                ({{ $manufacturer->region->name }})
                                                            </a></p>
                                                        @else 
                                                            <p><a href="{{ route('manufacturer', $manufacturer->id) }}">
                                                                {{ $manufacturer->name }}
                                                            </a></p>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </li>

                                            <br />

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

@section('scripts')

    <script src="/js/manufacturer-users.js"></script> 

@endsection