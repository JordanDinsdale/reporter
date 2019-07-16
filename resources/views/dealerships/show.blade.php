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

                    <h2>{{ $dealership->name }}</h2>

                    <p><a href="{{ route('dealershipEdit', $dealership->id) }}">Edit</a></p>

                    @if($dealership->group)

                        <h2><a href="{{ route('group', $dealership->group->id) }}">{{ $dealership->group->name }}</a></h2>

                    @endif

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

                    @if(count($dealership->events) > 0)

                        <h3>Events</h3>

                        <ul>

                            @foreach($dealership->events as $event)

                                <li><a href="{{ route('event', $event->id) }}">{{ $event->name }}</a></li>

                            @endforeach

                        </ul>

                    @endif

                    <h3>Add Event</h3>

                    <form method="post" action="{{ route('eventStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required />
                        </div>     
                        <div class="form-group">        
                            <label for="manufacturer_ids">Manufacturers</label>
                            <select multiple class="form-control" name="manufacturer_ids[]" id="manufacturer_ids" required/>
                                @foreach($dealership->manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id}}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" class="form-control" name="dealership_id" value="{{ $dealership->id }}" />
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

     <script src="/js/manufacturer-regions.js"></script> 

@endsection
