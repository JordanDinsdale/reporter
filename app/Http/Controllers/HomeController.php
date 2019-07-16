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
            $dealerships = Dealership::where('group_id',NULL)->orderBy('name')->get();
            $users = User::orderBy('surname')->get();

            return view('home',compact('user','companies','manufacturers','countries','groups','dealerships','users'));

        }

        else {

            return view('welcome');

        }

    }
}
