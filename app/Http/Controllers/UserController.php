<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Manufacturer;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = User::orderBy('surname')->get();
        $countries = Country::orderBy('name')->get();
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('users.index',compact('users','countries','manufacturers'));
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
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'level' => 'required'
        ]);

        $user = new User([
            'firstname' => $request->get('firstname'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'level' => $request->get('level'),
            'password' => bcrypt('secret'),
            'manufacturer_id' => $request->get('manufacturer_id'),
            'country_id' => $request->get('country_id'),
            'region_id' => $request->get('region_id'),
            'group_id' => $request->get('group_id'),
            'dealership_id' => $request->get('dealership_id')
        ]);

        $user->save();

        return redirect()->back()->with('success', 'User Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
