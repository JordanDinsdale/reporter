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

                    <h3>Add Manufacturer</h3>

                    <form method="post" action="{{ route('manufacturerStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="manufacturer">Name</label>
                            <input type="text" class="form-control" name="manufacturer"/>
                        </div>   
                        <div class="form-group">    
                            <label for="colour">Colour</label>
                            <input type="text" class="form-control" name="colour"/>
                        </div>                           
                        <button type="submit" class="btn btn-primary">Add Manufacturer</button>
                    </form>

                    @if($manufacturers)

                        <h2>Manufacturers</h2>

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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
