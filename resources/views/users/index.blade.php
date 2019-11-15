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

                    <h2>Add User</h2>

                    <form method="post" action="{{ route('userStore') }}">
                        @csrf
                        <div class="form-group">    
                            <label for="firstname">{{ __('First Name') }}</label>
                            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required />
                        </div>   
                        <div class="form-group">    
                            <label for="surname">{{ __('Surname') }}</label>
                            <input type="text" class="form-control" name="surname" value="{{ old('surname') }}" required />
                        </div>   
                        <div class="form-group">    
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required />
                        </div>    
                        <div class="form-group">    
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password" value="" required />
                        </div>   
                        <div class="form-group">    
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" value="" required />
                        </div>  
                        <div class="form-group">    
                            <label for="level">{{ __('Level') }}</label>
                            <select id="levels" class="form-control" name="level" required>
                                <option value="">{{ __('Level') }}</option>
                                <option value="Admin" @if(old('level') == 'Admin') selected @endif>{{ __('Admin') }}</option>
                                <option value="Company" @if(old('level') == 'Company') selected @endif>{{ __('Company') }}</option>
                                <option value="Manufacturer" @if(old('level') == 'Manufacturer') selected @endif>{{ __('Manufacturer') }}</option>
                                <option value="Country" @if(old('level') == 'Country') selected @endif>{{ __('Country') }}</option>
                                <option value="Region" @if(old('level') == 'Region') selected @endif>{{ __('Region') }}</option>
                                <option value="Group" @if(old('level') == 'Group') selected @endif>{{ __('Group') }}</option>
                                <option value="Dealership" @if(old('level') == 'Dealership') selected @endif>{{ __('Dealership') }}</option>
                            </select>
                        </div>  
                        <div id="companyContainer" class="form-group d-none">    
                            <label for="company_id">{{ __('Company') }}</label>
                            <select class="form-control" name="company_id" id="companies">
                                <option value="">{{ __('Select Company') }}</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id}}" @if(old('company_id') == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div id="manufacturerContainer" class="form-group d-none">    
                            <label for="manufacturer_id">{{ __('Manufacturer') }}</label>
                            <select class="form-control" name="manufacturer_id" id="manufacturers">
                                <option value="">Select Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id}}" @if(old('manufacturer_id') == $manufacturer->id) selected @endif>{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div id="countryContainer" class="form-group d-none">    
                            <label for="country_id">{{ __('Country') }}</label>
                            <select class="form-control" name="country_id" id="countries">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id}}" @if(old('country_id') == $country->id) selected @endif>{{ __($country->name) }}</option>
                                @endforeach
                            </select>
                        </div>   
                        <div id="regionContainer" class="form-group d-none">    
                            <label for="region_id">{{ __('Region') }}</label>
                            <select class="form-control" name="region_id" id="regions">
                                <option value="" @if(isset($region) && old('region_id') == $region->id) selected @endif>{{ __('Select Region') }}</option>
                                <option disabled="true" value="">{{ __('No regions currently available') }}</option>
                            </select>
                        </div>  
                        <div id="groupContainer" class="form-group d-none">    
                            <label for="group_id">{{ __('Group') }}</label>
                            <select class="form-control" name="group_id" id="groups">
                                <option value="">Select Group</option>
                                <option disabled="true" value="">No groups currently available</option>
                            </select>
                        </div>  
                        <div id="dealershipContainer" class="form-group d-none">    
                            <label for="dealership_id">{{ __('Dealership') }}</label>
                            <select class="form-control" name="dealership_id" id="dealerships">
                                <option value="">{{ __('Select Dealership') }}</option>
                                <option disabled="true" value="">{{ __('No dealerships currently available') }}</option>
                            </select>
                        </div>  
                        <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
                    </form>

                    @if(count($users) > 0)

                        <h2>{{ __('Users') }}</h2>

                        <ul>

                            @foreach($users as $user)

                                <li><a href="{{ route('user',$user->id) }}">{{ $user->firstname }} {{ $user->surname }}</a></li>

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

    <script src="/js/select-user-level.js"></script>
    <script src="/js/company-manufacturers.js"></script> 
    <script src="/js/manufacturer-countries.js"></script> 
    <script src="/js/country-manufacturer-regions.js"></script> 
    <script src="/js/country-groups.js"></script> 
    <script src="/js/country-dealerships.js"></script> 
    <script src="/js/group-dealerships.js"></script> 

@endsection
