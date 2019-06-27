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

                    <h1>{{ $appointment->firstname }} {{ $appointment->surname }}</h1>

                    <h2><a href="{{ route('dealership', $appointment->sales_executive->dealership->id) }}">{{ $appointment->sales_executive->dealership->name }}</a></h2>

                    <h3><a href="{{ route('manufacturer', $appointment->manufacturer->id) }}">{{ $appointment->manufacturer->name }}</a> (<a href="{{ route('region', $appointment->region->id) }}">{{ $appointment->region->name }}</a>)</h3>

                    <h4><a href="{{ route('user', $appointment->sales_executive->id) }}">{{ $appointment->sales_executive->firstname }} {{ $appointment->sales_executive->surname }}</a></h4>

                    <p>Created By: {{ $appointment->created_by->firstname }} {{ $appointment->created_by->surname }}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
