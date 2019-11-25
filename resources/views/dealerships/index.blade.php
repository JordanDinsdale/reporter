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

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(isset($success))
                        <p>{{ $success }}</p>
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
                            <select class="form-control" name="country_id" required/>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
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
