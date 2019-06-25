<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Region;
use App\Group;
use Illuminate\Http\Request;
use Auth;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('manufacturers.index',compact('manufacturers'));
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
            'manufacturer'=>'required',
            'colour' => 'required'
        ]);

        $manufacturer = new Manufacturer([
            'name' => $request->get('manufacturer'),
            'colour' => $request->get('colour')
        ]);

        $manufacturer->save();

        return redirect()->back()->with('success', 'Manufacturer Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        if($manufacturer->dealerships) {

            foreach($manufacturer->dealerships as $dealership) {

                $dealership->region = Region::find($dealership->pivot->region_id);
                
                $group_ids[] = $dealership->group->id;

            }

        }

        $group_ids = array_unique($group_ids);

        $groups = Group::whereIn('id',$group_ids)->get();

        return view('manufacturers.show',compact('manufacturer','groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function regionsApi($id)
    {
        $manufacturer = Manufacturer::find($id);

        return $manufacturer->regions;
    }
}
