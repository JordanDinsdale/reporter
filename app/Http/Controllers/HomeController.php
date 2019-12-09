<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Company;
use App\Manufacturer;
use App\Country;
use App\Region;
use App\Group;
use App\Dealership;
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
            $companies = Company::orderBy('name')->get();
            $countries = Country::orderBy('name')->get();
            $manufacturers = Manufacturer::orderBy('name')->get();
            $groups = Group::orderBy('name')->get();
            $dealerships = Dealership::orderBy('name')->get();
            $users = User::orderBy('surname')->get();

            switch (Auth::user()->level) {

                case 'Admin':
                    return view('home',compact('user','companies','manufacturers','countries','groups','dealerships','users'));
                break;

                case 'Company':
                    return redirect('/companies/' . Auth::user()->company_id);
                break;

                case 'Manufacturer':
                    return redirect('/manufacturers/' . Auth::user()->manufacturer_id);
                break;

                case 'Country':
                    return redirect('/manufacturers/' . Auth::user()->manufacturer_id . '/country/' . Auth::user()->country_id);
                break;

                case 'Region':
                    return redirect('/regions/' . Auth::user()->region_id);
                break;

                case 'Group':
                    return redirect('/groups/' . Auth::user()->group_id);
                break;

                case 'Dealership':
                    return redirect('/dealerships/' . Auth::user()->dealership_id);
                break;

            }

        }

        else {

            return view('welcome');

        }

    }
}
