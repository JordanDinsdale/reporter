<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use App\Manufacturer;
use Illuminate\Http\Request;
use Auth;
use DB;

class AppointmentController extends Controller
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
        $appointments = Appointment::all();
        $sales_executives = User::where('level','Sales Executive')->get();
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('appointments.index',compact('appointments','sales_executives','manufacturers'));
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
            'firstname' =>'required',
            'surname' => 'required',
            'sales_executive_id' => 'required',
            'manufacturer_id' => 'required',
        ]);

        $sales_executive = User::where('id',$request->get('sales_executive_id'))->first();

        $region_id = DB::table('dealership_manufacturer')->where('dealership_id',$sales_executive->dealership->id)->where('manufacturer_id',$request->get('manufacturer_id'))->value('region_id');

        $appointment = new Appointment([
            'firstname' => $request->get('firstname'),
            'surname' => $request->get('surname'),
            'sales' => $request->get('sale'),
            'sales_executive_id' => $request->get('sales_executive_id'),
            'manufacturer_id' => $request->get('manufacturer_id'),
            'region_id' => $region_id,
            'created_by_id' => Auth::user()->id
        ]);

        $appointment->save();

        return redirect()->back()->with('success', 'Appointment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('appointments.show',compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
