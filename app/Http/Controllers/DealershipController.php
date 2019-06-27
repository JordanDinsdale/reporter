<?php

namespace App\Http\Controllers;

use App\Dealership;
use App\Region;
use App\Manufacturer;
use App\Appointment;
use Illuminate\Http\Request;

class DealershipController extends Controller
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
        //
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
            'dealership'=>'required',
            'group_id' => 'required',
            'country_id' => 'required'
        ]);

        $dealership = new Dealership([
            'name' => $request->get('dealership'),
            'group_id' => $request->get('group_id'),
            'country_id' => $request->get('country_id')
        ]);

        $dealership->save();

        return redirect()->back()->with('success', 'Dealership Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealership = Dealership::find($id);

        if($dealership->manufacturers) {

            foreach($dealership->manufacturers as $manufacturer) {

                if($manufacturer->pivot->region_id) {

                    $manufacturer->region = Region::find($manufacturer->pivot->region_id);

                }

            }

        }

        $manufacturers = Manufacturer::orderBy('name')->get();

        $user_ids = [];

        if($dealership->users) {

            foreach($dealership->users as $user) {

                $user_ids[] = $user->id;

            }

        }

        $appointments = Appointment::whereIn('sales_executive_id',$user_ids)->get();

        return view('dealerships.show',compact('dealership','manufacturers','appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealership $dealership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dealership $dealership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dealership $dealership)
    {
        //
    }

    /**
     * Attach a manufacturer with region if one has been provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachManufacturer(Request $request)
    {
        $request->validate([
            'dealership_id'=>'required',
            'manufacturer_id' => 'required'
        ]);

        $dealership_id = $request->get('dealership_id');
        $manufacturer_id = $request->get('manufacturer_id');
        $region_id = $request->get('region_id');

        $dealership = Dealership::find($dealership_id);

        $dealership->manufacturers()->attach($manufacturer_id, array('region_id' => $region_id));

        return redirect()->back()->with('success', 'Manufacturer Added');
    }

    /**
     * Attach a manufacturer with region if one has been provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detachManufacturer(Request $request)
    {
        $request->validate([
            'dealership_id'=>'required',
            'manufacturer_id' => 'required'
        ]);

        $dealership_id = $request->get('dealership_id');
        $manufacturer_id = $request->get('manufacturer_id');

        $dealership = Dealership::find($dealership_id);

        $dealership->manufacturers()->detach($manufacturer_id);

        return redirect()->back()->with('success', 'Manufacturer Removed');
    }

}
