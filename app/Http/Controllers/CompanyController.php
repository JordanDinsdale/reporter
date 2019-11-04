<?php

namespace App\Http\Controllers;

use App\Company;
use App\Manufacturer;
use App\Country;
use App\Region;
use App\Dealership;
use App\Event;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use DB;

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

        $level = $request->level;

        $company->start_date = $start_date;
        $company->end_date = $end_date;        
        $company->data_count = 0;
        $company->appointments = 0;
        $company->new = 0;
        $company->used = 0;
        $company->demo = 0;
        $company->zero_km = 0;
        $company->inprogress = 0;   

        if($level == 'Company') {

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

        }

        if($level == 'Manufacturer') {

            $company->manufacturers = Manufacturer::where('id',$request->manufacturer_id)->get();

            foreach($company->manufacturers as $manufacturer) {

                $company->manufacturer = $manufacturer;

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

        }

        if($level == 'Country') {

            $company->country = Country::find($request->country_id);

            $company->manufacturers = Manufacturer::where('id',$request->manufacturer_id)->get();

            foreach($company->manufacturers as $manufacturer) {

                $company->manufacturer = $manufacturer;

                foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                    if($manufacturerEvent->dealership->country->id == $request->country_id) {

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

            }

        }

        if($level == 'Region') {

            $company->region = Region::find($request->region_id);

            $company->manufacturers = Manufacturer::where('id',$request->manufacturer_id)->get();

            foreach($company->manufacturers as $manufacturer) {

                $company->manufacturer = $manufacturer;

                foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                    foreach($manufacturerEvent->dealership->regions as $region) {

                        if($region->id == $request->region_id) {

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

                        $country = $region->country; 

                        $event_ids = [];

                        foreach($country->dealerships as $dealership) {

                            foreach($dealership->events as $dealershipEvent) {

                                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                                    if($dealershipEventManufacturer->id == $manufacturer->id) {

                                        $event_ids[] = $dealershipEvent->id;

                                    }

                                }

                            }

                        }

                        $country->events = Event::whereIn('id',$event_ids)->get();

                        $manufacturer->country = $region->country;
                        $manufacturer->country->data_count = 0;
                        $manufacturer->country->appointments = 0;
                        $manufacturer->country->new = 0;
                        $manufacturer->country->used = 0;
                        $manufacturer->country->demo = 0;
                        $manufacturer->country->zero_km = 0;
                        $manufacturer->country->inprogress = 0;

                        foreach($country->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $countryEvent) {

                            foreach($countryEvent->manufacturers as $countryEventManufacturer) {

                                if($countryEventManufacturer->id == $manufacturer->id) {

                                    $manufacturer->country->data_count += $countryEventManufacturer->pivot->data_count;
                                    $manufacturer->country->appointments += $countryEventManufacturer->pivot->appointments;
                                    $manufacturer->country->new += $countryEventManufacturer->pivot->new;
                                    $manufacturer->country->used += $countryEventManufacturer->pivot->used;
                                    $manufacturer->country->demo += $countryEventManufacturer->pivot->demo;
                                    $manufacturer->country->zero_km += $countryEventManufacturer->pivot->zero_km;
                                    $manufacturer->country->inprogress += $countryEventManufacturer->pivot->inprogress;

                                }

                            }

                        }

                    }

                }

            }

        }

        if($level == 'Dealership') {

            $company->dealership = Dealership::find($request->dealership_id);

            $manufacturer_ids = [];

            foreach($company->manufacturers as $manufacturer) {

                $region_id = DB::table('dealership_manufacturer')->where('dealership_id',$company->dealership->id)->where('manufacturer_id',$manufacturer->id)->value('region_id');

                if(isset($region_id)) {

                    $manufacturer->region = Region::find($region_id);   
                    $manufacturer->region->data_count = 0;
                    $manufacturer->region->appointments = 0;
                    $manufacturer->region->new = 0;
                    $manufacturer->region->used = 0;
                    $manufacturer->region->demo = 0;
                    $manufacturer->region->zero_km = 0;
                    $manufacturer->region->inprogress = 0; 

                }

                foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                    if($manufacturerEvent->dealership->id == $request->dealership_id) {

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

                        $manufacturer_ids[] = $manufacturer->id;

                    }

                    if(isset($region_id)) {

                        foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

                            foreach($manufacturerEvent->manufacturers as $manufacturerEventManufacturer) {

                                if($manufacturerEventManufacturer->id == $manufacturer->id) { 

                                    foreach($manufacturerEvent->dealership->regions as $manufacturerEventDealershipRegion) {

                                        if($manufacturerEventDealershipRegion->id == $manufacturer->region->id) {

                                            $manufacturer->region->data_count += $manufacturerEventManufacturer->pivot->data_count;
                                            $manufacturer->region->appointments += $manufacturerEventManufacturer->pivot->appointments;
                                            $manufacturer->region->new += $manufacturerEventManufacturer->pivot->new;
                                            $manufacturer->region->used += $manufacturerEventManufacturer->pivot->used;
                                            $manufacturer->region->demo += $manufacturerEventManufacturer->pivot->demo;
                                            $manufacturer->region->zero_km += $manufacturerEventManufacturer->pivot->zero_km;
                                            $manufacturer->region->inprogress += $manufacturerEventManufacturer->pivot->inprogress;

                                        }

                                    }                                

                                }

                            }

                        }

                    }

                    $country = $company->dealership->country; 

                    $event_ids = [];

                    foreach($country->dealerships as $dealership) {

                        foreach($dealership->events as $dealershipEvent) {

                            foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                                if($dealershipEventManufacturer->id == $manufacturer->id) {

                                    $event_ids[] = $dealershipEvent->id;

                                }

                            }

                        }

                    }

                    $country->events = Event::whereIn('id',$event_ids)->get();

                    $manufacturer->country = $company->dealership->country;
                    $manufacturer->country->data_count = 0;
                    $manufacturer->country->appointments = 0;
                    $manufacturer->country->new = 0;
                    $manufacturer->country->used = 0;
                    $manufacturer->country->demo = 0;
                    $manufacturer->country->zero_km = 0;
                    $manufacturer->country->inprogress = 0;

                    foreach($country->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $countryEvent) {

                        foreach($countryEvent->manufacturers as $countryEventManufacturer) {

                            if($countryEventManufacturer->id == $manufacturer->id) {

                                $manufacturer->country->data_count += $countryEventManufacturer->pivot->data_count;
                                $manufacturer->country->appointments += $countryEventManufacturer->pivot->appointments;
                                $manufacturer->country->new += $countryEventManufacturer->pivot->new;
                                $manufacturer->country->used += $countryEventManufacturer->pivot->used;
                                $manufacturer->country->demo += $countryEventManufacturer->pivot->demo;
                                $manufacturer->country->zero_km += $countryEventManufacturer->pivot->zero_km;
                                $manufacturer->country->inprogress += $countryEventManufacturer->pivot->inprogress;

                            }

                        }

                    }

                }

            }

        }

        $event_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->events as $event) {

                $event_ids[] = $event->id;

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        return view('companies.reportsdate',compact('company','events','level'));

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

        $formatted_start_date = Carbon::createFromFormat('Y-m-d',$start_date);
        $formatted_start_date = $formatted_start_date->format('d-m-Y');

        $formatted_end_date = Carbon::createFromFormat('Y-m-d',$end_date);
        $formatted_end_date = $formatted_end_date->format('d-m-Y');

        $filename = 'Rhino Events_' . $company->name . '_' . $formatted_start_date . ' - ' . $formatted_end_date . '.csv';

        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

        $company->start_date = $start_date;
        $company->end_date = $end_date;        

        $csv_headers = [''];
        $csv_second_row = [''];
        $csv_events = [''];

        $manufacturer_ids = [];
        $event_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            $manufacturer_ids[] = $manufacturer->id;

            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;
            $csv_headers[] = $manufacturer->name;

            $csv_second_row[] = 'Data Count';
            $csv_second_row[] = 'Appointments';
            $csv_second_row[] = 'Response Rate';
            $csv_second_row[] = 'New';
            $csv_second_row[] = 'Used';
            $csv_second_row[] = 'Demo';
            $csv_second_row[] = '0km';
            $csv_second_row[] = 'Coversion Rate';
            $csv_second_row[] = 'In Progress';

            foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $event) {

                $event_ids[] = $event->id;

            }

        }

        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';
        $csv_headers[] = 'Total';

        $csv_second_row[] = 'Data Count';
        $csv_second_row[] = 'Appointments';
        $csv_second_row[] = 'Response Rate';
        $csv_second_row[] = 'New';
        $csv_second_row[] = 'Used';
        $csv_second_row[] = 'Demo';
        $csv_second_row[] = '0km';
        $csv_second_row[] = 'Coversion Rate';
        $csv_second_row[] = 'In Progress';

        fputcsv($handle,$csv_headers);
        fputcsv($handle,$csv_second_row);

        $total_event_data = ['Total'];

        $events = Event::whereIn('id',$event_ids)->get();

        foreach($company->manufacturers as $companyManufacturer) {

            ${$companyManufacturer->name . '_total_data_count'} = 0;
            ${$companyManufacturer->name . '_total_appointments'} = 0;
            ${$companyManufacturer->name . '_total_new'} = 0;
            ${$companyManufacturer->name . '_total_used'} = 0;
            ${$companyManufacturer->name . '_total_demo'} = 0;
            ${$companyManufacturer->name . '_total_zero_km'} = 0;
            ${$companyManufacturer->name . '_total_inprogress'} = 0;

        }

        foreach($events as $event) {

            $event_data = [$event->name];

            $total_data_count = 0;
            $total_appointments = 0;
            $total_new = 0;
            $total_used = 0;
            $total_demo = 0;
            $total_zero_km = 0;
            $total_inprogress = 0;

            foreach($company->manufacturers as $companyManufacturer) {

                $manufacturer_data_count = '';
                $manufacturer_appointments = '';
                $manufacturer_response_rate = '';
                $manufacturer_new = '';
                $manufacturer_used = '';
                $manufacturer_demo = '';
                $manufacturer_zero_km = '';
                $manufacturer_conversion_rate = '';
                $manufacturer_inprogress = '';
                
                foreach($event->manufacturers as $manufacturer) {

                    if($manufacturer->id == $companyManufacturer->id) {

                        $manufacturer_data_count = $manufacturer->pivot->data_count;
                        $manufacturer_appointments = $manufacturer->pivot->appointments;
                        $manufacturer_response_rate = number_format($manufacturer->pivot->appointments/$manufacturer->pivot->data_count * 100, 2, '.', ',');
                        $manufacturer_new = $manufacturer->pivot->new;
                        $manufacturer_used = $manufacturer->pivot->used;
                        $manufacturer_demo = $manufacturer->pivot->demo;
                        $manufacturer_zero_km = $manufacturer->pivot->zero_km;
                        $manufacturer_conversion_rate = number_format(($manufacturer->pivot->new + $manufacturer->pivot->used + $manufacturer->pivot->demo + $manufacturer->pivot->zero_km)/$manufacturer->pivot->appointments * 100, 2, '.', ',');
                        $manufacturer_inprogress = $manufacturer->pivot->inprogress;

                        ${$companyManufacturer->name . '_total_data_count'} += $manufacturer->pivot->data_count;
                        ${$companyManufacturer->name . '_total_appointments'} += $manufacturer->pivot->appointments;
                        ${$companyManufacturer->name . '_total_new'} += $manufacturer->pivot->new;
                        ${$companyManufacturer->name . '_total_used'} += $manufacturer->pivot->used;
                        ${$companyManufacturer->name . '_total_demo'} += $manufacturer->pivot->demo;
                        ${$companyManufacturer->name . '_total_zero_km'} += $manufacturer->pivot->zero_km;
                        ${$companyManufacturer->name . '_total_inprogress'} += $manufacturer->pivot->inprogress;

                    }

                }

                $event_data[] = $manufacturer_data_count;
                $event_data[] = $manufacturer_appointments;
                if($manufacturer_response_rate > 0) {
                    $event_data[] = $manufacturer_response_rate . '%';
                }
                else {
                    $event_data[] = '';
                }
                $event_data[] = $manufacturer_new;
                $event_data[] = $manufacturer_used;
                $event_data[] = $manufacturer_demo;
                $event_data[] = $manufacturer_zero_km;
                if($manufacturer_conversion_rate > 0) {
                    $event_data[] = $manufacturer_conversion_rate . '%';
                }
                else {
                    $event_data[] = '';
                }
                $event_data[] = $manufacturer_inprogress;

                if(is_numeric($manufacturer_data_count)) {
                    $total_data_count += $manufacturer_data_count;
                }

                if(is_numeric($manufacturer_appointments)) {
                    $total_appointments += $manufacturer_appointments;
                }

                if(is_numeric($manufacturer_new)) {
                    $total_new += $manufacturer_new;
                }

                if(is_numeric($manufacturer_used)) {
                    $total_used += $manufacturer_used;
                }

                if(is_numeric($manufacturer_demo)) {
                    $total_demo += $manufacturer_demo;
                }

                if(is_numeric($manufacturer_zero_km)) {
                    $total_zero_km += $manufacturer_zero_km;
                }

                if(is_numeric($manufacturer_inprogress)) {
                    $total_inprogress += $manufacturer_inprogress;
                }

            }

            $event_data[] = $total_data_count;
            $event_data[] = $total_appointments;
            if($total_data_count > 0) {
                $event_data[] = number_format($total_appointments/$total_data_count * 100, 2, '.', ',') . '%';
            }
            else {
                $event_data[] = '';
            }
            $event_data[] = $total_new;
            $event_data[] = $total_used;
            $event_data[] = $total_demo;
            $event_data[] = $total_zero_km;
            if($total_appointments > 0) {
                $event_data[] = number_format(($total_new + $total_used + $total_demo + $total_zero_km)/$total_appointments * 100, 2, '.', ',') . '%';
            }
            else {
                $event_data[] = '';
            }
            $event_data[] = $total_inprogress;

            fputcsv($handle,$event_data);

        }

        $total_total_data_count = 0;
        $total_total_appointments = 0;
        $total_total_new = 0;
        $total_total_used = 0;
        $total_total_demo = 0;
        $total_total_zero_km = 0;
        $total_total_inprogress = 0;

        foreach($company->manufacturers as $companyManufacturer) {

            $total_event_data[] = ${$companyManufacturer->name . '_total_data_count'};
            $total_event_data[] = ${$companyManufacturer->name . '_total_appointments'};
            if(${$companyManufacturer->name . '_total_data_count'} > 0) {
                $total_event_data[] = number_format(${$companyManufacturer->name . '_total_appointments'}/${$companyManufacturer->name . '_total_data_count'} * 100, 2, '.', ',') . '%';
            }
            else {
                $total_event_data[] = '0%';
            }
            $total_event_data[] = ${$companyManufacturer->name . '_total_new'};
            $total_event_data[] = ${$companyManufacturer->name . '_total_used'};
            $total_event_data[] = ${$companyManufacturer->name . '_total_demo'};
            $total_event_data[] = ${$companyManufacturer->name . '_total_zero_km'};
            if(${$companyManufacturer->name . '_total_appointments'} > 0) {
                $total_event_data[] = number_format((${$companyManufacturer->name . '_total_new'} + ${$companyManufacturer->name . '_total_used'} + ${$companyManufacturer->name . '_total_demo'} + ${$companyManufacturer->name . '_total_zero_km'})/${$companyManufacturer->name . '_total_appointments'} * 100, 2, '.', ',') . '%';
            }
            else {
                $total_event_data[] = '0%';
            }
            $total_event_data[] = ${$companyManufacturer->name . '_total_inprogress'};

            $total_total_data_count += ${$companyManufacturer->name . '_total_data_count'};
            $total_total_appointments += ${$companyManufacturer->name . '_total_appointments'};
            $total_total_new += ${$companyManufacturer->name . '_total_new'};
            $total_total_used += ${$companyManufacturer->name . '_total_used'};
            $total_total_demo += ${$companyManufacturer->name . '_total_demo'};
            $total_total_zero_km += ${$companyManufacturer->name . '_total_zero_km'};
            $total_total_inprogress += ${$companyManufacturer->name . '_total_inprogress'};

        }

        $total_event_data[] = $total_total_data_count;
        $total_event_data[] = $total_total_appointments;
        if($total_total_data_count > 0) {
            $total_event_data[] = number_format($total_total_appointments/$total_total_data_count * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $total_total_new;
        $total_event_data[] = $total_total_used;
        $total_event_data[] = $total_total_demo;
        $total_event_data[] = $total_total_zero_km;
        if($total_total_appointments > 0) {
            $total_event_data[] = number_format(($total_total_new + $total_total_used + $total_total_demo + $total_total_zero_km)/$total_total_appointments * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $total_total_inprogress;

        fputcsv($handle,$total_event_data);

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


    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function companyCountriesApi($id)
    {

        $company = Company::find($id);

        $country_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->dealerships as $dealership) {

                $country_ids[] = $dealership->country->id;

            }

        }

        $countries = Country::whereIn('id',$country_ids)->get();

        return $countries;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function companyCountryDealershipsApi($company_id,$country_id)
    {

        $company = Company::find($company_id);

        $dealership_ids = [];

        foreach($company->manufacturers as $manufacturer) {

            foreach($manufacturer->dealerships as $dealership) {

                if($dealership->country->id == $country_id) {

                    $dealership_ids[] = $dealership->id;

                }

            }

        }

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        return $dealerships;

    }

}
