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

                    <h1>{{ $company->name }}</h1>

                    @if(count($company->manufacturers) > 0)

                        <ul>

                            @foreach($company->manufacturers as $manufacturer)

                                <li>

                                    <a href="{{ route('manufacturer',$manufacturer->id) }}">{{ $manufacturer->name }}</a>

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