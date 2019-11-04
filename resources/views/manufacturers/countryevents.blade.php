@extends('layouts.app')

@section('page_title')

    <h1>Events</h1>
    
@endsection

@section('content')

<div class="events">

    <div class="container-fluid">

        <div class="container">

            <div class="row">

                @if($events_without_data > 0)

                    <div class="col-md-12  add-events">

                        <h2>Missing Event data</h2>

                        @foreach($country->events as $event)

                            @if($event->missing_data)

                                <div class="event-to-add">

                                    <div class="event-name">

                                        <i class="fas fa-chart-line"></i><p>{{ $event->name }}</p>
                                        
                                    </div>

                                    <div class="dates">

                                        @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                        @else

                                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                        @endif

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                @endif

                @if($events_with_data > 0)

                    <div class="col-md-12  past-events">

                        <h2>Past Event data</h2>

                        @foreach($country->events as $event)

                            @if(!$event->missing_data)

                                <div class="event">

                                    <a href="{{ route('eventManufacturerCountry', [$event->id,$country->manufacturer->id]) }}">

                                        <div class="event-name">
                                            <i class="fas fa-chart-line"></i><p>{{ $event->name }}</p>
                                        </div>

                                        <div class="dates">

                                            @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

                                                <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                            @else

                                                <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>

                                            @endif

                                        </div>

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
