<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Manufacturer;
use App\Company;
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
        $companies = Company::orderBy('name')->get();
        return view('users.index',compact('users','countries','manufacturers','companies'));
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

        $level = $request->get('level');

        switch ($level) {

            case 'Admin':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required'
                ]);

            break;
            
            case 'Company':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'company_id' => 'required'
                ]);

            break;
            
            case 'Manufacturer':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'manufacturer_id' => 'required'
                ]);

            break;
            
            case 'Country':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'manufacturer_id' => 'required',
                    'country_id' => 'required'
                ]);

            break;
            
            case 'Region':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'manufacturer_id' => 'required',
                    'country_id' => 'required',
                    'region_id' => 'required'
                ]);

            break;
            
            case 'Group':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'group_id' => 'required'
                ]);

            break;
            
            case 'Group':

                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required',
                    'dealership_id' => 'required'
                ]);

            break;

            default:
                
                $request->validate([
                    'firstname' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email',
                    'level' => 'required'
                ]);
        } 

        $company_id = $request->get('company_id');
        if($company_id == 'NULL') {
            $company_id = NULL;
        }

        $manufacturer_id = $request->get('manufacturer_id');
        if($manufacturer_id == 'NULL') {
            $manufacturer_id = NULL;
        }

        $country_id = $request->get('country_id');
        if($country_id == 'NULL') {
            $country_id = NULL;
        }

        $region_id = $request->get('region_id');
        if($region_id == 'NULL') {
            $region_id = NULL;
        }

        $group_id = $request->get('group_id');
        if($group_id == 'NULL') {
            $group_id = NULL;
        }

        $dealership_id = $request->get('dealership_id');
        if($dealership_id == 'NULL') {
            $dealership_id = NULL;
        }

        $user = new User([
            'firstname' => $request->get('firstname'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'level' => $request->get('level'),
            'password' => bcrypt('secret'),
            'company_id' => $company_id,
            'manufacturer_id' => $manufacturer_id,
            'country_id' => $country_id,
            'region_id' => $region_id,
            'group_id' => $group_id,
            'dealership_id' => $dealership_id
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
