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

                    <form method="post" action="{{ route('eventStore') }}">

                        @csrf

                        <div class="form-group">    

                            <label for="name">{{ ('Name') }}</label>
                            <input type="text" class="form-control" name="name"/>

                            <label for="start_date">{{ ('Start Date') }}</label>
                            <input type="text" class="form-control datepicker-here" data-language="en" name="start_date"/>

                            <label for="end_date">{{ ('End Date') }}</label>
                            <input type="text" class="form-control datepicker-here" data-language="en" name="end_date"/>

                            <label for="dealership_id">{{ ('Dealership') }}</label>
                            <select name="dealership_id">
                                <option value="">Select Dealership</option>
                                @foreach($dealerships as $dealership)
                                    <option value="{{ $dealership->id }}">{{ __($dealership->name) }}</option>
                                @endforeach

                            </select>

                            <br />

                            <label for="dealership">{{ ('Manufacturers') }}</label>
                            @foreach($manufacturers as $manufacturer)
                                <br /><input type="checkbox" name="manufacturer_ids[]" value="{{ $manufacturer->id }}" />{{ __($manufacturer->name) }}
                            @endforeach

                        </div>   

                        <button type="submit" class="btn btn-primary">{{ ('Add Event') }}</button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

@endsection
