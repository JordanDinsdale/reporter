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

                    <form method="post" action="{{ route('dealershipUpdate', $dealership->id) }}">    
                        @csrf
                        <div class="form-group">    
                            <label for="dealership">{{ __('Edit Dealership') }}</label>
                            <input type="text" class="form-control" name="dealership" value="{{ $dealership->name }}" />
                        </div>   
                        <button type="submit" class="btn btn-primary">{{ __('Edit Dealership') }}</button>
                    </form>

                    <form method="post" action="{{ route('attachManufacturer') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="manufacturer_id">Add Manufacturer</label>
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

                                    <a href="{{ route('manufacturer', $manufacturer->id) }}">{{ $manufacturer->name }}</a>

                                    <form method="post" action="{{ route('detachManufacturer') }}">
                                        @csrf
                                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />     
                                        <input type="hidden" name="dealership_id" value="{{ $dealership->id }}" />           
                                        <button type="submit">Remove Manufacturer</button>
                                    </form>

                                    <form method="post" action="{{ route('updateRegion') }}">
                                        @csrf
                                        <select class="form-control" name="region_id">

                                            <option value="">No Region</option>
                                
                                            @if(count($manufacturer->regions) > 0)

                                                @foreach($manufacturer->regions as $region)

                                                    @if($region->country->id == $dealership->country->id)

                                                        <option value="{{ $region->id }}" @if(isset($manufacturer->region->id) && $manufacturer->region->id == $region->id) selected @endif>{{ $region->name }}</option>

                                                    @endif

                                                @endforeach

                                            @endif

                                        </select>     

                                        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}" />     
                                        <input type="hidden" name="dealership_id" value="{{ $dealership->id }}" />

                                        <button type="submit">Change Region</button>

                                    </form>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
