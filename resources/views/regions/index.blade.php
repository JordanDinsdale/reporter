@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

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
                                    <li>{{ __($error) }}</li>
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

                    @if($regions)

                        <h2>{{ __('Regions') }}</h2>

                        <h3>Add Region</h3>

                        <form method="post" action="{{ route('regionStore') }}">
                            @csrf
                            <div class="form-group">    
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name"/>
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
                            <div class="form-group">    
                                <label for="manufacturer_id">Manufacturer</label>
                                <select class="form-control" name="manufacturer_id" required/>
                                    <option value="">Select Manufacturer</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>      
                            <button type="submit" class="btn btn-primary">Add Region</button>
                        </form>

                        <ul>

                            @foreach($regionManufacturers as $regionManufacturer)

                                <li><a href="{{ route('manufacturer',$regionManufacturer->id) }}">{{ $regionManufacturer->name }}</a></li>

                                @if($regionManufacturer->regions)

                                    <ul>

                                        @foreach($regionManufacturer->regions as $region)

                                            <li>
                                                <a href="{{ route('region',$region->id) }}">{{ $region->name }}</a> | <a href="{{ route('regionEdit',$region->id) }}">Edit</a> |
                                                <form action="{{ route('regionDestroy', $region->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit">{{ __('Delete') }}</button>
                                                </form>
                                            </li>

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
