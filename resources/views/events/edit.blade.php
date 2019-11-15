@extends('layouts.app')

@section('page_title')

    <h1>{{ $event->name }}</h1>

    <h3>
        
        @if(\Carbon\Carbon::parse($event->start_date)->format('M') == \Carbon\Carbon::parse($event->end_date)->format('M'))

            {{ \Carbon\Carbon::parse($event->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}

        @else

            {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}

        @endif

    </h3>

@endsection

@section('content')

    <div class="add-event">

        <div class="container-fluid">

            <div  class="container">
            
                <div class="row">

                    <div class="col-md-12 main-content">

                        <div class="container">

                            <div class="row">

                                @if(count($event->manufacturers) > 1)

                                    <div class="col-md-10 Brand-form-menu">

                                        <div>

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

                                            <select>

                                                <option>{{ __('Edit a Brand') }}</option>

                                                @foreach($event->manufacturers->sortBy('name') as $manufacturer)

                                                    <option value="{{ str_replace(' ','-',strtolower($manufacturer->name)) }}" @if(\Session::get('manufacturer_id') == $manufacturer->id) selected @endif>{{ $manufacturer->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                @endif

                                @foreach($event->manufacturers->sortBy('name') as $manufacturer)

                                    <form method="post" action="{{ route('eventUpdateSync', [$event->id, $manufacturer->id]) }}" class="{{ str_replace(' ','-',strtolower($manufacturer->name)) }} box col-md-10" @if(count($event->manufacturers) > 1) style="display:none;" @endif>

                                        @csrf

                                        <div class="row">

                                            <div class="col-md-12 brand-name">

                                                <img src="/images/logos/{{ $manufacturer->url }}.png" alt=""> <h2>{{ $manufacturer->name }} {{ __('Event Data') }}</h2>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-input">
                                                    <label for="data_count">{{ __('Data Count') }}</label>
                                                    <input id="data_count" type="number" name="data_count" step="1" value="{{ $manufacturer->pivot->data_count }}">
                                                </div>

                                                <div class="form-input">
                                                    <label for="appointments">{{ __('Appointments') }}</label>
                                                    <input id="appointments" type="number" name="appointments" step="1" value="{{ $manufacturer->pivot->appointments }}">
                                                </div>

                                                <div class="form-input">
                                                    <label for="new">{{ __('New Vehicle Sales') }}</label>
                                                    <input id="new" type="number" name="new" step="1" value="{{ $manufacturer->pivot->new }}">
                                                </div>

                                                <div class="form-input">
                                                    <label for="used">{{ __('Used Vehicle Sales') }}</label>
                                                    <input id="used" type="number" name="used" step="1" value="{{ $manufacturer->pivot->used }}">
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-input">
                                                    <label for="demo">{{ __('Demo Vehicle Sales') }}</label>
                                                    <input id="demo" type="number" name="demo" step="1" value="{{ $manufacturer->pivot->demo }}">
                                                </div>

                                                <div class="form-input">
                                                    <label for="zero_km">{{ __('Okm Vehicle Sales') }}</label>
                                                    <input id="zero_km" type="number" name="zero_km" step="1" value="{{ $manufacturer->pivot->zero_km }}">
                                                </div>

                                                <div class="form-input">
                                                    <label for="inprogress">{{ __('In Progress Vehicle Sales') }}</label>
                                                    <input id="inprogress" type="number" name="inprogress" step="1" value="{{ $manufacturer->pivot->inprogress }}">
                                                </div>

                                                <button type="submit" name="button" class="btn">{{ __('CONFIRM') }}</button>

                                            </div>

                                        </div>

                                    </form>

                                @endforeach

                            </div>

                        </div>
            
                    </div>

                </div>

            </div>

        </div>

    </div>
    
@endsection

@section('scripts')

<script type="text/javascript">

    $(document).ready(function(){

        $("select").change(function(){

            $(this).find("option:selected").each(function(){

                var optionValue = $(this).attr("value");

                if(optionValue){

                    $(".box").not("." + optionValue).hide();

                    $("." + optionValue).show();


                } else{

                    $(".box").hide();

                }

            });

        });

    });

</script>

@endsection
