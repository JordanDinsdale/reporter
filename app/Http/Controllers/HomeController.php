<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\Manufacturer;
use App\Group;
use App\Region;
use App\User;
use App\Appointment;


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

            if(Auth::user()->level == 'Manufacturer') {

                $manufacturer_id = Auth::user()->manufacturer_id;
                $manufacturer = Manufacturer::find($manufacturer_id);

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

            if(Auth::user()->level == 'National') {

                $country_id = Auth::user()->country_id;
                $country = Country::find($country_id);

                $manufacturer_id = Auth::user()->manufacturer_id;
                $manufacturer = Manufacturer::find($manufacturer_id);

                $group_ids = [];

                $appoinments = [];

                if(count($manufacturer->dealerships) > 0) {

                    $appointment_ids = [];

                    foreach($manufacturer->dealerships as $dealership) {

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
