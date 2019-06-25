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
                        <div class="form-group">    
                            <label for="sales_executive_id">Sales Executive</label>
                            <select class="form-control" name="sales_executive_id" required/>
                                <option value="">Select Sales Executive</option>
                                @foreach($sales_executives as $sales_executive)
                                    <option value="{{ $sales_executive->id}}">{{ $sales_executive->firstname }} {{ $sales_executive->surname }}</option>
                                @endforeach
                            </select>
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
                        <div id="regionContainer" class="form-group d-none">    
                            <label for="region_id">Region</label>
                            <select class="form-control" name="region_id" id="regions"/>
                            </select>
                        </div>      
                        -->
                                
                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </form>

                    @if($appointments)

                        <h2>Appointments</h2>

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
