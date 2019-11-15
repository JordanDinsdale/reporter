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

                    <form method="post" action="{{ route('companyStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="company">{{ __('Add Company') }}</label>
                            <input type="text" class="form-control" name="company"/>
                        </div>   
                        <button type="submit" class="btn btn-primary">{{ __('Add Company') }}</button>
                    </form>

                    @if(count($companies) > 0)

                        <h2>{{ __('Companies') }}</h2>

                        <ul>

                            @foreach($companies as $company)

                                <li>

                                    <h3><a href="{{ route('company',$company->id) }}">{{ __($company->name) }}</a></h3>

                                    @if(count($company->manufacturers) > 0)

                                        <ul>

                                            @foreach($company->manufacturers as $manufacturer)

                                                <li>

                                                    <a href="{{ route('manufacturer',$manufacturer->id) }}">{{ __($manufacturer->name) }}</a>

                                                </li>

                                            @endforeach

                                        </ul>

                                    @endif

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
