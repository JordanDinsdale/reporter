<?php

namespace App\Http\Controllers;

use App\Company;
use App\Manufacturer;
use App\Country;
use App\Event;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

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
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDates(Request $request, $company_id)
    {

        $company = Company::find($company_id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $company->start_date = $start_date;
        $company->end_date = $end_date;        
        $company->data_count = 0;
        $company->appointments = 0;
        $company->new = 0;
        $company->used = 0;
        $company->demo = 0;
        $company->zero_km = 0;
        $company->inprogress = 0;     

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                $company->data_count += $manufacturerEvent->pivot->data_count;
                $company->appointments += $manufacturerEvent->pivot->appointments;
                $company->new += $manufacturerEvent->pivot->new;
                $company->used += $manufacturerEvent->pivot->used;
                $company->demo += $manufacturerEvent->pivot->demo;
                $company->zero_km += $manufacturerEvent->pivot->zero_km;
                $company->inprogress += $manufacturerEvent->pivot->inprogress;

                $manufacturer->data_count += $manufacturerEvent->pivot->data_count;
                $manufacturer->appointments += $manufacturerEvent->pivot->appointments;
                $manufacturer->new += $manufacturerEvent->pivot->new;
                $manufacturer->used += $manufacturerEvent->pivot->used;
                $manufacturer->demo += $manufacturerEvent->pivot->demo;
                $manufacturer->zero_km += $manufacturerEvent->pivot->zero_km;
                $manufacturer->inprogress += $manufacturerEvent->pivot->inprogress;

            }

        }

        $event_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->events as $event) {

                $event_ids[] = $event->id;

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        return view('companies.reportsdate',compact('company','events'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDatesDownload($company_id, $start_date, $end_date)
    {

        $company = Company::find($company_id);

        $filename = $company->name . ' ' . $start_date . ' - ' . $end_date . '.csv';

        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

        fputcsv($handle, 
            array( 
                'Manufacturer',
                'Data Count', 
                'Appointments', 
                'New', 
                'Used', 
                'Demo', 
                '0km', 
                'In Progress'
            )
        );

        $company->start_date = $start_date;
        $company->end_date = $end_date;        
        $company->data_count = 0;
        $company->appointments = 0;
        $company->new = 0;
        $company->used = 0;
        $company->demo = 0;
        $company->zero_km = 0;
        $company->inprogress = 0;  

        foreach($company->manufacturers as $manufacturer) {  

            $manufacturer->data_count = 0;
            $manufacturer->appointments = 0;
            $manufacturer->new = 0;
            $manufacturer->used = 0;
            $manufacturer->demo = 0;
            $manufacturer->zero_km = 0;
            $manufacturer->inprogress = 0;

            foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                $company->data_count += $manufacturerEvent->pivot->data_count;
                $company->appointments += $manufacturerEvent->pivot->appointments;
                $company->new += $manufacturerEvent->pivot->new;
                $company->used += $manufacturerEvent->pivot->used;
                $company->demo += $manufacturerEvent->pivot->demo;
                $company->zero_km += $manufacturerEvent->pivot->zero_km;
                $company->inprogress += $manufacturerEvent->pivot->inprogress;

                $manufacturer->data_count += $manufacturerEvent->pivot->data_count;
                $manufacturer->appointments += $manufacturerEvent->pivot->appointments;
                $manufacturer->new += $manufacturerEvent->pivot->new;
                $manufacturer->used += $manufacturerEvent->pivot->used;
                $manufacturer->demo += $manufacturerEvent->pivot->demo;
                $manufacturer->zero_km += $manufacturerEvent->pivot->zero_km;
                $manufacturer->inprogress += $manufacturerEvent->pivot->inprogress;

            }

            fputcsv($handle, 
                array(
                    $manufacturer->name,
                    $manufacturer->data_count, 
                    $manufacturer->appointments, 
                    $manufacturer->new, 
                    $manufacturer->used, 
                    $manufacturer->demo, 
                    $manufacturer->zero_km, 
                    $manufacturer->inprogress
                )
            );

        }

        fputcsv($handle, 
            array(
                'Total',
                $company->data_count, 
                $company->appointments, 
                $company->new, 
                $company->used, 
                $company->demo, 
                $company->zero_km, 
                $company->inprogress
            )
        );

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8'
        );

        return response()->download('csv/' . $filename, $filename, $headers);

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
