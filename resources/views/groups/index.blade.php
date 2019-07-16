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

                    <form method="post" action="{{ route('groupStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="group">Add Group</label>
                            <input type="text" class="form-control" name="group"/>
                        </div>   
                        <button type="submit" class="btn btn-primary">Add Group</button>
                    </form>

                    @if($groups)

                        <h2>Groups</h2>

                        <ul>

                            @foreach($groups as $group)

                                <li>
                                    <a href="{{ route('group',$group->id) }}">{{ $group->name }}</a> | <a href="{{ route('groupEdit',$group->id) }}">Edit</a> |
                                     <form action="{{ route('groupDestroy', $group->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </li>

                            @endforeach

                        </ul>

                    @endif

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
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>       
                        <div class="form-group">
                            <label for="group_id">Group</label>
                            <select class="form-control" name="group_id"/>
                                <option value="">Select Group</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>             
                        <button type="submit" class="btn btn-primary">Add Dealership</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
