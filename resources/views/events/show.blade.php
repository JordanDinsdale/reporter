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

                    <h2>{{ $event->name }}</h2>

                    <p><a href="{{ route('dealership', $event->dealership->id) }}">{{ $event->dealership->name }}</a></p>

                    <p><a href="{{ route('group', $event->dealership->group->id) }}">{{ $event->dealership->group->name }}</a></p>

                    <h3>Update Event</h3>

                    <form method="post" action="{{ route('eventUpdate', $event->id) }}">
                        @csrf
                        <div class="form-group">    
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $event->name }}" required />
                        </div>     
                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </form>

                    @foreach($event->manufacturers as $manufacturer)

                        <h4>{{ $manufacturer->name }}</h4>

                        <form method="post" action="{{ route('eventUpdateSync', [$event->id, $manufacturer->id]) }}">
                            @csrf
                            <div class="form-group">    
                                <label for="data_count">Data Count</label>
                                <input type="number" class="form-control" name="data_count" value="{{ $manufacturer->pivot->data_count }}" required />
                            </div>         
                            <div class="form-group">    
                                <label for="appointments">Appointments</label>
                                <input type="number" class="form-control" name="appointments" value="{{ $manufacturer->pivot->appointments }}" required />
                            </div>          
                            <div class="form-group">    
                                <label for="new">New Vehicle Sales</label>
                                <input type="number" class="form-control" name="new" value="{{ $manufacturer->pivot->new }}" required />
                            </div>           
                            <div class="form-group">    
                                <label for="used">Used Vehicle Sales</label>
                                <input type="number" class="form-control" name="used" value="{{ $manufacturer->pivot->used }}" required />
                            </div>            
                            <div class="form-group">    
                                <label for="zero_km">0km Vehicle Sales</label>
                                <input type="number" class="form-control" name="zero_km" value="{{ $manufacturer->pivot->zero_km }}" required />
                            </div>            
                            <div class="form-group">    
                                <label for="demo">Demo Vehicle Sales</label>
                                <input type="number" class="form-control" name="demo" value="{{ $manufacturer->pivot->demo }}" required />
                            </div>           
                            <div class="form-group">    
                                <label for="inprogress">In Progress Vehicle Sales</label>
                                <input type="number" class="form-control" name="inprogress" value="{{ $manufacturer->pivot->inprogress }}" required />
                            </div>    
                            <button type="submit" class="btn btn-primary">Update {{ $manufacturer->name }}</button>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

     <script src="/js/manufacturer-regions.js"></script> 

@endsection