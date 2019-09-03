<?php

namespace App\Http\Controllers;

use App\Company;
use App\Manufacturer;
use App\Country;
use App\Event;
use Illuminate\Http\Request;
use DateTime;

class CompanyController extends Controller
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
        $companies = Company::orderBy('name')->get();
        return view('companies.index',compact('companies'));
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
            'company'=>'required'
        ]);

        $company = new Company([
            'name' => $request->get('company')
        ]);

        $company->save();

        return redirect()->back()->with('success', 'Company Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $company->data_count = 0;
        $company->appointments = 0;
        $company->new = 0;
        $company->used = 0;
        $company->demo = 0;
        $company->zero_km = 0;
        $company->inprogress = 0;

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->events->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo) as $event) {

                $company->data_count += $event->pivot->data_count;
                $company->appointments += $event->pivot->appointments;
                $company->new += $event->pivot->new;
                $company->used += $event->pivot->used;
                $company->demo += $event->pivot->demo;
                $company->zero_km += $event->pivot->zero_km;
                $company->inprogress += $event->pivot->inprogress;

            }
        }

        return view('companies.show',compact('company'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function events($id)
    {
        $company = Company::find($id);

        $events_with_data = 0;

        $events_without_data = 0;

        $event_ids = [];

        $manufacturer_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            $manufacturer_ids[] = $manufacturer->id;

            foreach($manufacturer->events as $event) {

                $event_ids[] = $event->id;

            }

        }

        $company->events = Event::whereIn('id',$event_ids)->get();

        foreach($company->events as $event) {

            $event->missing_data = false;

            foreach($event->manufacturers as $manufacturer) {

                if(in_array($manufacturer->id, $manufacturer_ids)) {

                    if($manufacturer->pivot->data_count == 0 && $manufacturer->pivot->appointments == 0 && $manufacturer->pivot->new == 0 && $manufacturer->pivot->used == 0 && $manufacturer->pivot->zero_km == 0 && $manufacturer->pivot->demo == 0 && $manufacturer->pivot->inprogress == 0) {

                        $event->missing_data = true;

                        $events_without_data++;

                    }

                }

            }

            if(!$event->missing_data) {

                $events_with_data++;

            }

        }

        return view('companies.events',compact('company','events_with_data','events_without_data'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function reports($company_id)
    {

        $company = Company::find($company_id);

        $event_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->events as $event) {

                $event_ids[] = $event->id;

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        return view('companies.reports',compact('company','events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function companyManufacturersApi($id)
    {

        if($id !== 'NULL') {

            $company = Company::find($id);
            return $company->manufacturers;

        }

        else {

            $manufacturers = Manufacturer::orderby('name')->get();
            return $manufacturers;

        }

    }

}
