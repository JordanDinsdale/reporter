<?php

namespace App\Http\Controllers;

use App\Region;
use App\Manufacturer;
use Illuminate\Http\Request;

class RegionController extends Controller
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
        $regions = Region::orderBy('manufacturer_id')->get();
        $manufacturer_ids = Region::distinct('manufacturer_id')->pluck('manufacturer_id');
        $manufacturers = Manufacturer::whereIn('id',$manufacturer_ids)->get();
        return view('regions.index',compact('regions','manufacturers'));
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
            'region'=>'required',
            'country_id' => 'required',
            'manufacturer_id' => 'required'
        ]);

        $region = new Region([
            'name' => $request->get('region'),
            'country_id' => $request->get('country_id'),
            'manufacturer_id' => $request->get('manufacturer_id')
        ]);

        $region->save();

        return redirect()->back()->with('success', 'Region Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);
        return view('regions.show',compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'region'=>'required'
        ]);

        $region = Region::find($id);
        $region->name = $request->get('region');

        $region->save();

        return redirect()->route('regions')->with('success', 'Region Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();

        return redirect()->back()->with('success', 'Region Deleted');
    }
}
