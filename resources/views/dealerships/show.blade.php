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

                    <h1>{{ $dealership->name }}</h1>

                    <h2><a href="{{ route('country', $dealership->country->id) }}">{{ $dealership->country->name }}</a></h2>
                    
                    <h3>Manufacturers</h3>

                    <h3>Add Manufacturer</h3>

                    <form method="post" action="{{ route('attachManufacturer') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="manufacturer_id">Manufacturer</label>
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
                        <button type="submit" class="btn btn-primary">Attach Manufacturer</button>
                    </form>

                    @if(count($dealership->manufacturers) > 0)
                        <ul>
                            @foreach($dealership->manufacturers as $manufacturer)
                                @if($manufacturer->region)
                                    <li><a href="{{ route('region', $manufacturer->region->id) }}">{{ $manufacturer->name }} ({{ $manufacturer->region->name }})</a></li>
                                @else
                                    <li><a href="{{ route('manufacturer', $manufacturer->id) }}">{{ $manufacturer->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>

        $( document ).ready(function() {

            $('select#manufacturers').on('change', function() {

                let manufacturer_id = this.value;

                let dropdown = $('select#regions');

                dropdown.empty();

                dropdown.append('<option selected="true" disabled>Select Region</option>');
                dropdown.prop('selectedIndex', 0);

                const url = '/api/manufacturers/' + manufacturer_id + '/regions';

                // Populate dropdown with list of provinces
                $.getJSON(url, function (data) {

                    if(data.length > 0) {
                        $('#regionContainer').removeClass('d-none');
                    }

                    $.each(data, function (key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
                    })
                });

            });

        });

    </script>

@endsection
