<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\Manufacturer;
use App\Group;
use App\Region;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $countries = Country::all();
        $manufacturers = Manufacturer::all();
        $groups = Group::all();

        // Add region relationship to dealership->manufacturer

        if($groups) {

            foreach($groups as $group) {

                if($group->dealerships) {

                    foreach($group->dealerships as $dealership) {

                        if($dealership->manufacturers) {

                            foreach($dealership->manufacturers as $manufacturer) {

                                if($manufacturer->pivot->region_id) {

                                    $manufacturer->region = Region::find($manufacturer->pivot->region_id);

                                }

                            }

                        }

                    }

                }

            }

        }

        return view('home',compact('user','countries','manufacturers','groups'));

    }
}
