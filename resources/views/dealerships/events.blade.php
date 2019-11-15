@extends('layouts.app')

@section('page_title')

    <h1>{{ __('Events') }}</h1>
    
@endsection

@section('content')

<div class="events">

    <div class="container-fluid">

        <div class="container">

            <div class="row">

                @if($events_without_data > 0)

                    <div class="col-md-12  add-events">

                        <h2>{{ __('Missing Event Data') }}</h2>

                        @foreach($dealership->events as $event)

                            @if($event->missing_data)

                                <div class="event-to-add">

                                    <div class="event-name">

                                        <i class="fas fa-chart-line"></i><p>{{ __($event->name) }}</p>
                                        
                                    </div>

                                    <div class="dates">

                                        @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                        @else

                                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                        @endif

                                    </div>

                                    <a href="{{ route('eventEdit', $event->id) }}" class="btn">{{ __('Add Data') }}</a>

                                </div>

                            @endif

                        @endforeach

                    </div>

                @endif

                @if($events_with_data > 0)

                    <div class="col-md-12  past-events">

                        <h2>{{ __('Past Event Data') }}</h2>

                        @foreach($dealership->events as $event)

                            @if(!$event->missing_data)

                                <div class="event">

                                    <a href="{{ route('event', $event->id) }}">

                                        <div class="event-name">
                                            <i class="fas fa-chart-line"></i><p>{{ __($event->name) }}</p>
                                        </div>

                                        <div class="dates">

                                            @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                                <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                            @else

                                                <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                            @endif

                                        </div>

                                        <a href="{{ route('eventEdit', $event->id) }}" class="btn">{{ __('Edit') }}</a>

                                    </a>
                                    
                                </div>

                            @endif

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection


<!--

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
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control start_date" required />
                            <input type="hidden" class="alt_start_date" name="start_date" required />
                        </div>    
                        <div class="form-group">    
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control end_date" required />
                            <input type="hidden" class="alt_end_date" name="end_date" required />
                        </div>     
                        <div class="form-group">        
                            <p>Manufacturers</p>
                            @foreach($dealership->manufacturers as $manufacturer)
                                <label><input type="checkbox" name="manufacturer_ids[]" value="{{ $manufacturer->id }}" />{{ $manufacturer->name }}</label>
                            @endforeach
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

    <script>
        $( function() {

            $( ".start_date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                altFormat: "yy-mm-dd",
                altField: ".alt_start_date"
            });

            $( ".end_date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                altFormat: "yy-mm-dd",
                altField: ".alt_end_date"
            });

        } );
    </script>

@endsection

-->
