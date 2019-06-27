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

                    <h2>Add User</h2>

                    <form method="post" action="{{ route('userStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" name="firstname"/>
                        </div>   
                        <div class="form-group">    
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" name="surname"/>
                        </div>   
                        <div class="form-group">    
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"/>
                        </div>   
                        <div class="form-group">    
                            <label for="level">Level</label>
                            <select class="form-control" name="level" required/>
                                <option value="">Level</option>
                                <option value="Sales Executive">Sales Executive</option>
                                <option value="Dealership">Dealership</option>
                                <option value="Group">Group</option>
                                <option value="Regional">Regional</option>
                                <option value="Manufacturer">Manufacturer</option>
                                <option value="National">National</option>
                                <option value="International">International</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>  
                        <div class="form-group">    
                            <label for="country_id">Country</label>
                            <select class="form-control" name="country_id" id="countries" />
                                <option value="">Country</option>                                
                                @foreach($countries as $country)
                                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">    
                            <label for="manufacturer_id">Manufacturer</label>
                            <select class="form-control" name="manufacturer_id" id="manufacturers" />
                                <option value="">Manufacturer</option>                                
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id}}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">    
                            <label for="region_id">Region</label>
                            <select class="form-control" name="region_id" id="regions" />
                                <option value="">Region</option>
                            </select>
                        </div>  
                        <div class="form-group">    
                            <label for="group_id">Group</label>
                            <select class="form-control" name="group_id" id="groups" />
                                <option value="">Group</option>
                            </select>
                        </div>  
                        <div class="form-group">    
                            <label for="dealership_id">Dealership</label>
                            <select class="form-control" name="dealership_id" id="dealerships" />
                                <option value="">Dealership</option>
                            </select>
                        </div>  
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>

                    @if($users)

                        <h2>Users</h2>

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

     <script src="/js/country-groups.js"></script> 
     <script src="/js/country-manufacturer-regions.js"></script> 
     <script src="/js/group-dealerships.js"></script> 

@endsection
