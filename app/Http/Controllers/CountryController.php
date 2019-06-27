<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use App\Group;
use App\Dealership;
use App\Appointment;
use Illuminate\Http\Request;
use DB;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country'=>'required'
        ]);

        $country = new Country([
            'name' => $request->get('country')
        ]);

        $country->save();

        return redirect()->back()->with('success', 'Country Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);

        $group_ids = [];

        $appoinments = [];

        if(count($country->dealerships) > 0) {

            foreach($country->dealerships as $dealership) {

                $group_ids[] = $dealership->group->id;

                foreach($dealership->users as $user) {

                    foreach($user->appointments as $appointment) {

                        $appointment_ids[] = $appointment->id;

                    }

                }

            }

            $groups = Group::whereIn('id',$group_ids)->orderBy('name')->get();

            $appointments = Appointment::whereIn('id',$appointment_ids)->get();

        }



        return view('countries.show',compact('country','groups','appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'country'=>'required'
        ]);

        $country = Country::find($id);
        $country->name = $request->get('country');

        $country->save();

        return redirect()->route('countries')->with('success', 'Country Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();

        return redirect()->route('countries')->with('success', 'Country Deleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function countryGroupsApi($id)
    {
        $country = Country::find($id);

        $dealership_ids = [];

        if(count($country->dealerships) > 0) {

            foreach($country->dealerships as $dealership) {

                $dealership_ids[] = $dealership->id;

            }

        }

        $group_ids = Dealership::whereIn('id',$dealership_ids)->distinct()->pluck('group_id');

        $groups = Group::whereIn('id',$group_ids)->orderBy('name')->get();

        return $groups;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function countryManufacturerRegionsApi($country_id,$manufacturer_id)
    {
        $country = Country::find($country_id);

        $dealership_ids = [];

        if(count($country->dealerships) > 0) {

            foreach($country->dealerships as $dealership) {

                $dealership_ids[] = $dealership->id;

            }

        }

        $region_ids = DB::table('dealership_manufacturer')->where('manufacturer_id',$manufacturer_id)->whereIn('dealership_id',$dealership_ids)->pluck('region_id');

        $regions = Region::whereIn('id',$region_ids)->get();

        return $regions;

    }


}
