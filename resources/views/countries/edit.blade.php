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

                    <form method="post" action="{{ route('countryUpdate', $country->id) }}">    
                        @csrf
                        <div class="form-group">    
                            <label for="country">{{ __('Edit Country') }}</label>
                            <input type="text" class="form-control" name="country" value="{{ $country->name }}" />
                        </div>   
                        <button type="submit" class="btn btn-primary">{{ __('Edit Country') }}</button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
