<?php

namespace App\Http\Controllers;

use App\Group;
use App\Country;
use App\Appointment;
use Illuminate\Http\Request;

class GroupController extends Controller
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
        $groups = Group::all();
        return view('groups.index',compact('groups'));
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
            'group' =>'required'
        ]);

        $group = new Group([
            'name' => $request->get('group')
        ]);

        $group->save();

        return redirect()->back()->with('success', 'Group Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        $countries = Country::orderBy('name')->get();

        $appointment_ids = [];

        foreach($group->dealerships as $dealership) {

            foreach($dealership->users as $user) {

                foreach($user->appointments as $appointment) {

                    $appointment_ids[] = $appointment->id;

                }

            }

        }

        $appointments = Appointment::whereIn('id',$appointment_ids)->get();

        return view('groups.show',compact('group','countries','appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'group'=>'required'
        ]);

        $group = Group::find($id);
        $group->name = $request->get('group');

        $group->save();

        return redirect()->route('groups')->with('success', 'Group Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        return redirect()->route('groups')->with('success', 'Group Deleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function groupDealershipsApi($id)
    {
        $group = Group::find($id);

        return $group->dealerships;
    }

}
