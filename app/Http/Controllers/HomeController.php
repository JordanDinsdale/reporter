<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\Manufacturer;
use App\Group;
use App\Region;
use App\User;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()) {

            $user = Auth::user();
            $users = User::orderBy('surname')->get();
            $countries = Country::orderBy('name')->get();
            $manufacturers = Manufacturer::orderBy('name')->get();
            $groups = Group::orderBy('name')->get();
            $sales_executives = User::where('level','Sales Executive')->get();

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

            return view('home',compact('user','users','countries','manufacturers','groups','sales_executives'));

        }

        else {

            return view('welcome');

        }

    }
}
