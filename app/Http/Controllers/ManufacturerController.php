<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Country;
use App\Region;
use App\Group;
use App\Dealership;
use App\Event;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DateTime;
use DB;

class ManufacturerController extends Controller
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
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('manufacturers.index',compact('manufacturers'));
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
            'manufacturer'=>'required',
            'colour' => 'required'
        ]);

        $manufacturer = new Manufacturer([
            'name' => $request->get('manufacturer'),
            'colour' => $request->get('colour')
        ]);

        $manufacturer->save();

        return redirect()->back()->with('success', 'Manufacturer Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $manufacturer->data_count = 0;
        $manufacturer->appointments = 0;
        $manufacturer->new = 0;
        $manufacturer->used = 0;
        $manufacturer->demo = 0;
        $manufacturer->zero_km = 0;
        $manufacturer->inprogress = 0;

        $manufacturerEvents = $manufacturer->events->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo);

        foreach($manufacturerEvents as $manufacturerEvent) {

            $manufacturer->data_count += $manufacturerEvent->pivot->data_count;
            $manufacturer->appointments += $manufacturerEvent->pivot->appointments;
            $manufacturer->new += $manufacturerEvent->pivot->new;
            $manufacturer->used += $manufacturerEvent->pivot->used;
            $manufacturer->demo += $manufacturerEvent->pivot->demo;
            $manufacturer->zero_km += $manufacturerEvent->pivot->zero_km;
            $manufacturer->inprogress += $manufacturerEvent->pivot->inprogress;

        }

        return view('manufacturers.show',compact('manufacturer'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function events($manufacturer_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);

        $events_with_data = 0;

        $events_without_data = 0;

        foreach($manufacturer->events as $event) {

            $event->missing_data = false;

            if($event->pivot->data_count == 0 && $event->pivot->appointments == 0 && $event->pivot->new == 0 && $event->pivot->used == 0 && $event->pivot->zero_km == 0 && $event->pivot->demo == 0 && $event->pivot->inprogress == 0) {

                $event->missing_data = true;

                $events_without_data++;

            }

            if(!$event->missing_data) {

                $events_with_data++;

            }

        }

        return view('manufacturers.events',compact('manufacturer','events_with_data','events_without_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function reports($manufacturer_id)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        return view('manufacturers.reports',compact('manufacturer'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDates(Request $request, $manufacturer_id)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $manufacturer->start_date = $start_date;
        $manufacturer->end_date = $end_date;        
        $manufacturer->data_count = 0;
        $manufacturer->appointments = 0;
        $manufacturer->new = 0;
        $manufacturer->used = 0;
        $manufacturer->demo = 0;
        $manufacturer->zero_km = 0;
        $manufacturer->inprogress = 0;     

        foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

            $manufacturer->data_count += $manufacturerEvent->pivot->data_count;
            $manufacturer->appointments += $manufacturerEvent->pivot->appointments;
            $manufacturer->new += $manufacturerEvent->pivot->new;
            $manufacturer->used += $manufacturerEvent->pivot->used;
            $manufacturer->demo += $manufacturerEvent->pivot->demo;
            $manufacturer->zero_km += $manufacturerEvent->pivot->zero_km;
            $manufacturer->inprogress += $manufacturerEvent->pivot->inprogress;

        }

        return view('manufacturers.reportsdate',compact('manufacturer'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDatesDownload($manufacturer_id, $start_date, $end_date)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        $formatted_start_date = Carbon::createFromFormat('Y-m-d',$start_date);
        $formatted_start_date = $formatted_start_date->format('d-m-Y');

        $formatted_end_date = Carbon::createFromFormat('Y-m-d',$end_date);
        $formatted_end_date = $formatted_end_date->format('d-m-Y');

        $filename = 'Rhino Events_' . $manufacturer->name . '_' . $formatted_start_date . ' - ' . $formatted_end_date . '.csv';

        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

        fputcsv($handle, 
            array( 
                '',
                'Data Count', 
                'Appointments', 
                'Response Rate',
                'New', 
                'Used', 
                'Demo', 
                '0km', 
                'Conversion Rate',
                'In Progress'
            )
        );

        $manufacturer->start_date = $start_date;
        $manufacturer->end_date = $end_date;        
        $manufacturer->data_count = 0;
        $manufacturer->appointments = 0;
        $manufacturer->new = 0;
        $manufacturer->used = 0;
        $manufacturer->demo = 0;
        $manufacturer->zero_km = 0;
        $manufacturer->inprogress = 0;     

        foreach($manufacturer->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $manufacturerEvent) {

            $event_data = [];

            $event_data[] = $manufacturerEvent->name;
            $event_data[] = $manufacturerEvent->pivot->data_count;
            $event_data[] = $manufacturerEvent->pivot->appointments;
            if($manufacturerEvent->pivot->appointments > 0) {
                $event_data[] = number_format($manufacturerEvent->pivot->appointments/$manufacturerEvent->pivot->data_count * 100, 2, '.', ',') . '%';
            }
            else {
                $event_data[] = '0%';
            }
            $event_data[] = $manufacturerEvent->pivot->new;
            $event_data[] = $manufacturerEvent->pivot->used;
            $event_data[] = $manufacturerEvent->pivot->demo;
            $event_data[] = $manufacturerEvent->pivot->zero_km;
            if($manufacturerEvent->pivot->appointments > 0) {
                $event_data[] = number_format(($manufacturerEvent->pivot->new + $manufacturerEvent->pivot->used + $manufacturerEvent->pivot->demo + $manufacturerEvent->pivot->zero_km)/$manufacturerEvent->pivot->appointments * 100, 2, '.', ',') . '%';
            }
            else {
                $event_data[] = '0%';
            }
            $event_data[] = $manufacturerEvent->pivot->inprogress;

            fputcsv($handle, $event_data);

            $manufacturer->data_count += $manufacturerEvent->pivot->data_count;
            $manufacturer->appointments += $manufacturerEvent->pivot->appointments;
            $manufacturer->new += $manufacturerEvent->pivot->new;
            $manufacturer->used += $manufacturerEvent->pivot->used;
            $manufacturer->demo += $manufacturerEvent->pivot->demo;
            $manufacturer->zero_km += $manufacturerEvent->pivot->zero_km;
            $manufacturer->inprogress += $manufacturerEvent->pivot->inprogress;

        }

        $total_event_data = ['Total'];

        $total_event_data[] = $manufacturer->data_count;
        $total_event_data[] = $manufacturer->appointments;
        if($manufacturer->appointments > 0) {
            $total_event_data[] = number_format($manufacturer->appointments/$manufacturer->data_count * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $manufacturer->new;
        $total_event_data[] = $manufacturer->used;
        $total_event_data[] = $manufacturer->demo;
        $total_event_data[] = $manufacturer->zero_km;
        if($manufacturer->appointments > 0) {
            $total_event_data[] = number_format(($manufacturer->new + $manufacturer->used + $manufacturer->demo + $manufacturer->zero_km)/$manufacturer->appointments * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $manufacturer->inprogress;

        fputcsv($handle, $total_event_data);

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
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function country($manufacturer_id,$country_id)
    {
        $country = Country::find($country_id);

        $country->manufacturer = Manufacturer::find($manufacturer_id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $dealership_ids = [];

        foreach($country->dealerships as $dealership) {

            $dealership_ids[] = $dealership->id;

        }

        $countryEvents = Event::whereIn('dealership_id',$dealership_ids)->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo)->get();

        $country->data_count = 0;
        $country->appointments = 0;
        $country->new = 0;
        $country->used = 0;
        $country->demo = 0;
        $country->zero_km = 0;
        $country->inprogress = 0;

        foreach($countryEvents as $countryEvent) {

            foreach($countryEvent->manufacturers as $countryEventManufacturer) {

                if($countryEventManufacturer->id == $country->manufacturer->id) {

                    $country->data_count += $countryEventManufacturer->pivot->data_count;
                    $country->appointments += $countryEventManufacturer->pivot->appointments;
                    $country->new += $countryEventManufacturer->pivot->new;
                    $country->used += $countryEventManufacturer->pivot->used;
                    $country->demo += $countryEventManufacturer->pivot->demo;
                    $country->zero_km += $countryEventManufacturer->pivot->zero_km;
                    $country->inprogress += $countryEventManufacturer->pivot->inprogress;

                }

            }

        }

        return view('manufacturers.country',compact('country'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function countryEvents($manufacturer_id,$country_id)
    {
        $country = Country::find($country_id);

        $country->manufacturer = Manufacturer::find($manufacturer_id);

        $events_with_data = 0;

        $events_without_data = 0;

        $event_ids = [];

        foreach($country->dealerships as $dealership) {

            if(count($dealership->events) > 0) {

                foreach($dealership->events as $event) {

                    foreach($event->manufacturers as $manufacturer) {

                        if($manufacturer->id == $country->manufacturer->id) {

                            $event_ids[] = $event->id;

                        }

                    }

                }

            }

        }

        $country->events = Event::whereIn('id',$event_ids)->get();

        foreach($country->events as $event) {

            $event->missing_data = false;

            foreach($event->manufacturers as $manufacturer) {

                if($manufacturer->pivot->data_count == 0 && $manufacturer->pivot->appointments == 0 && $manufacturer->pivot->new == 0 && $manufacturer->pivot->used == 0 && $manufacturer->pivot->zero_km == 0 && $manufacturer->pivot->demo == 0 && $manufacturer->pivot->inprogress == 0) {

                    $event->missing_data = true;

                    $events_without_data++;

                }

            }

            if(!$event->missing_data) {

                $events_with_data++;

            }

        }

        return view('manufacturers.countryevents',compact('country','events_with_data','events_without_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function countryReports($manufacturer_id,$country_id)
    {

        $country = Country::find($country_id);

        $country->manufacturer = Manufacturer::find($manufacturer_id);

        foreach($country->dealerships as $dealership) {

            if(count($dealership->events) > 0) {

                foreach($dealership->events as $event) {

                    foreach($event->manufacturers as $manufacturer) {

                        if($manufacturer->id == $country->manufacturer->id) {

                            $event_ids[] = $event->id;

                        }

                    }

                }

            }

        }

        $country->events = Event::whereIn('id',$event_ids)->get();

        return view('manufacturers.countryreports',compact('country'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countryReportDates(Request $request,$manufacturer_id,$country_id)
    {

        $country = Country::find($country_id);

        $country->manufacturer = Manufacturer::find($manufacturer_id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $event_ids = [];

        foreach($country->dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $country->manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $country->events = Event::whereIn('id',$event_ids)->get();

        $country->start_date = $start_date;
        $country->end_date = $end_date;        
        $country->data_count = 0;
        $country->appointments = 0;
        $country->new = 0;
        $country->used = 0;
        $country->demo = 0;
        $country->zero_km = 0;
        $country->inprogress = 0;     

        foreach($country->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $countryEvent) {

            foreach($countryEvent->manufacturers as $countryEventManufacturer) {

                if($countryEventManufacturer->id == $country->manufacturer->id) {

                    $country->data_count += $countryEventManufacturer->pivot->data_count;
                    $country->appointments += $countryEventManufacturer->pivot->appointments;
                    $country->new += $countryEventManufacturer->pivot->new;
                    $country->used += $countryEventManufacturer->pivot->used;
                    $country->demo += $countryEventManufacturer->pivot->demo;
                    $country->zero_km += $countryEventManufacturer->pivot->zero_km;
                    $country->inprogress += $countryEventManufacturer->pivot->inprogress;

                }

            }

        }

        return view('manufacturers.countryreportsdate',compact('country'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countryReportDatesDownload($manufacturer_id, $country_id, $start_date, $end_date)
    {

        $country = Country::find($country_id);

        $country->manufacturer = Manufacturer::find($manufacturer_id);

        $formatted_start_date = Carbon::createFromFormat('Y-m-d',$start_date);
        $formatted_start_date = $formatted_start_date->format('d-m-Y');

        $formatted_end_date = Carbon::createFromFormat('Y-m-d',$end_date);
        $formatted_end_date = $formatted_end_date->format('d-m-Y');

        $filename = 'Rhino Events_' . $country->manufacturer->name . ' ' . $country->name . '_' . $formatted_start_date . ' - ' . $formatted_end_date . '.csv';
        
        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

        fputcsv($handle, 
            array( 
                '',
                'Data Count', 
                'Appointments', 
                'Response Rate',
                'New', 
                'Used', 
                'Demo', 
                '0km', 
                'Conversion Rate',
                'In Progress'
            )
        );

        $event_ids = [];

        foreach($country->dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $country->manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $country->events = Event::whereIn('id',$event_ids)->get();

        $country->start_date = $start_date;
        $country->end_date = $end_date;        
        $country->data_count = 0;
        $country->appointments = 0;
        $country->new = 0;
        $country->used = 0;
        $country->demo = 0;
        $country->zero_km = 0;
        $country->inprogress = 0;     

        foreach($country->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $countryEvent) {

            foreach($countryEvent->manufacturers as $countryEventManufacturer) {

                if($countryEventManufacturer->id == $country->manufacturer->id) {

                    $event_data = [];

                    $event_data[] = $countryEvent->name;
                    $event_data[] = $countryEventManufacturer->pivot->data_count;
                    $event_data[] = $countryEventManufacturer->pivot->appointments;
                    if($countryEventManufacturer->pivot->appointments > 0) {
                        $event_data[] = number_format($countryEventManufacturer->pivot->appointments/$countryEventManufacturer->pivot->data_count * 100, 2, '.', ',') . '%';
                    }
                    else {
                        $event_data[] = '0%';
                    }
                    $event_data[] = $countryEventManufacturer->pivot->new;
                    $event_data[] = $countryEventManufacturer->pivot->used;
                    $event_data[] = $countryEventManufacturer->pivot->demo;
                    $event_data[] = $countryEventManufacturer->pivot->zero_km;
                    if($countryEventManufacturer->pivot->appointments > 0) {
                        $event_data[] = number_format(($countryEventManufacturer->pivot->new + $countryEventManufacturer->pivot->used + $countryEventManufacturer->pivot->demo + $countryEventManufacturer->pivot->zero_km)/$countryEventManufacturer->pivot->appointments * 100, 2, '.', ',') . '%';
                    }
                    else {
                        $event_data[] = '0%';
                    }
                    $event_data[] = $countryEventManufacturer->pivot->inprogress;

                    fputcsv($handle, $event_data);

                    $country->data_count += $countryEventManufacturer->pivot->data_count;
                    $country->appointments += $countryEventManufacturer->pivot->appointments;
                    $country->new += $countryEventManufacturer->pivot->new;
                    $country->used += $countryEventManufacturer->pivot->used;
                    $country->demo += $countryEventManufacturer->pivot->demo;
                    $country->zero_km += $countryEventManufacturer->pivot->zero_km;
                    $country->inprogress += $countryEventManufacturer->pivot->inprogress;

                }

            }

        }

        $total_event_data = ['Total'];

        $total_event_data[] = $country->data_count;
        $total_event_data[] = $country->appointments;
        if($country->appointments > 0) {
            $total_event_data[] = number_format($country->appointments/$country->data_count * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $country->new;
        $total_event_data[] = $country->used;
        $total_event_data[] = $country->demo;
        $total_event_data[] = $country->zero_km;
        if($country->appointments > 0) {
            $total_event_data[] = number_format(($country->new + $country->used + $country->demo + $country->zero_km)/$country->appointments * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $country->inprogress;

        fputcsv($handle, $total_event_data);

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8'
        );

        return response()->download('csv/' . $filename, $filename, $headers);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function regionless($manufacturer_id,$country_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);

        $country = Country::find($country_id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $manufacturer->country_data_count = 0;
        $manufacturer->country_appointments = 0;
        $manufacturer->country_new = 0;
        $manufacturer->country_used = 0;
        $manufacturer->country_demo = 0;
        $manufacturer->country_zero_km = 0;
        $manufacturer->country_inprogress = 0;

        $countryDealership_ids = [];

        foreach($country->dealerships as $countryDealership) {

            $countryDealership_ids[] = $countryDealership->id;

            foreach($countryDealership->events->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo) as $countryDealershipEvent) {

                foreach($countryDealershipEvent->manufacturers as $countryDealershipEventManufacturer) {

                    if($countryDealershipEventManufacturer->id == $manufacturer->id) {

                        $manufacturer->country_data_count += $countryDealershipEventManufacturer->pivot->data_count;
                        $manufacturer->country_appointments += $countryDealershipEventManufacturer->pivot->appointments;
                        $manufacturer->country_new += $countryDealershipEventManufacturer->pivot->new;
                        $manufacturer->country_used += $countryDealershipEventManufacturer->pivot->used;
                        $manufacturer->country_demo += $countryDealershipEventManufacturer->pivot->demo;
                        $manufacturer->country_zero_km += $countryDealershipEventManufacturer->pivot->zero_km;
                        $manufacturer->country_inprogress += $countryDealershipEventManufacturer->pivot->inprogress;

                    }

                }

            }

        }

        $dealership_ids = DB::table('dealership_manufacturer')->whereIn('dealership_id',$countryDealership_ids)->where('manufacturer_id',$manufacturer->id)->where('region_id',NULL)->pluck('dealership_id');

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        $manufacturer->region_data_count = 0;
        $manufacturer->region_appointments = 0;
        $manufacturer->region_new = 0;
        $manufacturer->region_used = 0;
        $manufacturer->region_demo = 0;
        $manufacturer->region_zero_km = 0;
        $manufacturer->region_inprogress = 0;

        foreach($dealerships as $dealership) {

            foreach($dealership->events->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo) as $event) {

                foreach($event->manufacturers as $eventManufacturer) {

                    if($eventManufacturer->id == $manufacturer->id) {

                        $manufacturer->region_data_count += $eventManufacturer->pivot->data_count;
                        $manufacturer->region_appointments += $eventManufacturer->pivot->appointments;
                        $manufacturer->region_new += $eventManufacturer->pivot->new;
                        $manufacturer->region_used += $eventManufacturer->pivot->used;
                        $manufacturer->region_demo += $eventManufacturer->pivot->demo;
                        $manufacturer->region_zero_km += $eventManufacturer->pivot->zero_km;
                        $manufacturer->region_inprogress += $eventManufacturer->pivot->inprogress;

                    }

                }

            }

        }

        return view('manufacturers.regionless',compact('manufacturer','country'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function regionlessEvents($manufacturer_id,$country_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);

        $country = Country::find($country_id);

        $countryDealership_ids = [];

        foreach($country->dealerships as $countryDealership) {

            $countryDealership_ids[] = $countryDealership->id;

        }

        $dealership_ids = DB::table('dealership_manufacturer')->whereIn('dealership_id',$countryDealership_ids)->where('manufacturer_id',$manufacturer->id)->where('region_id',NULL)->pluck('dealership_id');

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        $event_ids = [];

        foreach($dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        $events_with_data = 0;

        $events_without_data = 0;

        foreach($events as $event) {

            $event->missing_data = false;

            foreach($event->manufacturers as $eventManufacturer) {

                if($eventManufacturer->id == $manufacturer->id) {

                    if($eventManufacturer->pivot->data_count == 0 && $eventManufacturer->pivot->appointments == 0 && $eventManufacturer->pivot->new == 0 && $eventManufacturer->pivot->used == 0 && $eventManufacturer->pivot->zero_km == 0 && $eventManufacturer->pivot->demo == 0 && $eventManufacturer->pivot->inprogress == 0) {

                        $event->missing_data = true;
 
                        $events_without_data++;

                    }

                }

            }

            if(!$event->missing_data) {

                $events_with_data++;

            }

        }

        return view('manufacturers.regionlessevents',compact('manufacturer','country','events','events_with_data','events_without_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function regionlessReports($manufacturer_id,$country_id)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        $country = Country::find($country_id);

        $countryDealership_ids = [];

        foreach($country->dealerships as $countryDealership) {

            $countryDealership_ids[] = $countryDealership->id;

        }

        $dealership_ids = DB::table('dealership_manufacturer')->whereIn('dealership_id',$countryDealership_ids)->where('manufacturer_id',$manufacturer->id)->where('region_id',NULL)->pluck('dealership_id');

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        $event_ids = [];

        foreach($dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        return view('manufacturers.regionlessreports',compact('manufacturer','country','events'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regionlessReportDates(Request $request,$manufacturer_id,$country_id)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        $country = Country::find($country_id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $event_ids = [];

        $country->data_count = 0;
        $country->appointments = 0;
        $country->new = 0;
        $country->used = 0;
        $country->demo = 0;
        $country->zero_km = 0;
        $country->inprogress = 0; 

        $countryDealership_ids = [];

        foreach($country->dealerships as $countryDealership) {

            $countryDealership_ids[] = $countryDealership->id;

            foreach($countryDealership->events as $countryDealershipEvent) {

                foreach($countryDealershipEvent->manufacturers as $countryDealershipEventManufacturer) {

                    if($countryDealershipEventManufacturer->id == $manufacturer->id) {

                        $country->data_count += $countryDealershipEventManufacturer->pivot->data_count;
                        $country->appointments += $countryDealershipEventManufacturer->pivot->appointments;
                        $country->new += $countryDealershipEventManufacturer->pivot->new;
                        $country->used += $countryDealershipEventManufacturer->pivot->used;
                        $country->demo += $countryDealershipEventManufacturer->pivot->demo;
                        $country->zero_km += $countryDealershipEventManufacturer->pivot->zero_km;
                        $country->inprogress += $countryDealershipEventManufacturer->pivot->inprogress; 

                    }

                }

            }

        }

        $dealership_ids = DB::table('dealership_manufacturer')->whereIn('dealership_id',$countryDealership_ids)->where('manufacturer_id',$manufacturer->id)->where('region_id',NULL)->pluck('dealership_id');

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        $event_ids = [];

        foreach($dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        $events->start_date = $start_date;
        $events->end_date = $end_date;        
        $events->data_count = 0;
        $events->appointments = 0;
        $events->new = 0;
        $events->used = 0;
        $events->demo = 0;
        $events->zero_km = 0;
        $events->inprogress = 0;     

        foreach($events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $event) {

            foreach($event->manufacturers as $eventManufacturer) {

                if($eventManufacturer->id == $manufacturer->id) {

                    $events->data_count += $eventManufacturer->pivot->data_count;
                    $events->appointments += $eventManufacturer->pivot->appointments;
                    $events->new += $eventManufacturer->pivot->new;
                    $events->used += $eventManufacturer->pivot->used;
                    $events->demo += $eventManufacturer->pivot->demo;
                    $events->zero_km += $eventManufacturer->pivot->zero_km;
                    $events->inprogress += $eventManufacturer->pivot->inprogress;

                }

            }

        }

        return view('manufacturers.regionlessreportsdate',compact('manufacturer','country','events'));
    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regionlessReportDatesDownload($manufacturer_id, $country_id, $start_date, $end_date)
    {

        $manufacturer = Manufacturer::find($manufacturer_id);

        $country = Country::find($country_id);

        $formatted_start_date = Carbon::createFromFormat('Y-m-d',$start_date);
        $formatted_start_date = $formatted_start_date->format('d-m-Y');

        $formatted_end_date = Carbon::createFromFormat('Y-m-d',$end_date);
        $formatted_end_date = $formatted_end_date->format('d-m-Y');

        $filename = 'Rhino Events_' . $manufacturer->name . ' ' . $country->name . ' No Region_' . $formatted_start_date . ' - ' . $formatted_end_date . '.csv';
        
        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

        fputcsv($handle, 
            array( 
                '',
                'Data Count', 
                'Appointments', 
                'Response Rate',
                'New', 
                'Used', 
                'Demo', 
                '0km', 
                'Conversion Rate',
                'In Progress'
            )
        );

        $countryDealership_ids = [];

        foreach($country->dealerships as $countryDealership) {

            $countryDealership_ids[] = $countryDealership->id;

        }

        $dealership_ids = DB::table('dealership_manufacturer')->whereIn('dealership_id',$countryDealership_ids)->where('manufacturer_id',$manufacturer->id)->where('region_id',NULL)->pluck('dealership_id');

        $dealerships = Dealership::whereIn('id',$dealership_ids)->get();

        $event_ids = [];

        foreach($dealerships as $dealership) {

            foreach($dealership->events as $dealershipEvent) {

                foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                    if($dealershipEventManufacturer->id == $manufacturer->id) {

                        $event_ids[] = $dealershipEvent->id;

                    }

                }

            }

        }

        $events = Event::whereIn('id',$event_ids)->get();

        $events->start_date = $start_date;
        $events->end_date = $end_date;        
        $events->data_count = 0;
        $events->appointments = 0;
        $events->new = 0;
        $events->used = 0;
        $events->demo = 0;
        $events->zero_km = 0;
        $events->inprogress = 0;     

        foreach($events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $event) {

            foreach($event->manufacturers as $eventManufacturer) {

                if($eventManufacturer->id == $manufacturer->id) {

                    $event_data = [];

                    $event_data[] = $event->name;
                    $event_data[] = $eventManufacturer->pivot->data_count;
                    $event_data[] = $eventManufacturer->pivot->appointments;
                    if($eventManufacturer->pivot->appointments > 0) {
                        $event_data[] = number_format($eventManufacturer->pivot->appointments/$eventManufacturer->pivot->data_count * 100, 2, '.', ',') . '%';
                    }
                    else {
                        $event_data[] = '0%';
                    }
                    $event_data[] = $eventManufacturer->pivot->new;
                    $event_data[] = $eventManufacturer->pivot->used;
                    $event_data[] = $eventManufacturer->pivot->demo;
                    $event_data[] = $eventManufacturer->pivot->zero_km;
                    if($eventManufacturer->pivot->appointments > 0) {
                        $event_data[] = number_format(($eventManufacturer->pivot->new + $eventManufacturer->pivot->used + $eventManufacturer->pivot->demo + $eventManufacturer->pivot->zero_km)/$eventManufacturer->pivot->appointments * 100, 2, '.', ',') . '%';
                    }
                    else {
                        $event_data[] = '0%';
                    }
                    $event_data[] = $eventManufacturer->pivot->inprogress;

                    fputcsv($handle, $event_data);

                    $events->data_count += $eventManufacturer->pivot->data_count;
                    $events->appointments += $eventManufacturer->pivot->appointments;
                    $events->new += $eventManufacturer->pivot->new;
                    $events->used += $eventManufacturer->pivot->used;
                    $events->demo += $eventManufacturer->pivot->demo;
                    $events->zero_km += $eventManufacturer->pivot->zero_km;
                    $events->inprogress += $eventManufacturer->pivot->inprogress;

                }

            }

        }

        $total_event_data = ['Total'];

        $total_event_data[] = $events->data_count;
        $total_event_data[] = $events->appointments;
        if($events->appointments > 0) {
            $total_event_data[] = number_format($events->appointments/$events->data_count * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $events->new;
        $total_event_data[] = $events->used;
        $total_event_data[] = $events->demo;
        $total_event_data[] = $events->zero_km;
        if($events->appointments > 0) {
            $total_event_data[] = number_format(($events->new + $events->used + $events->demo + $events->zero_km)/$events->appointments * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $events->inprogress;

        fputcsv($handle, $total_event_data);

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8'
        );

        return response()->download('csv/' . $filename, $filename, $headers);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function manufacturerCountriesApi($id)
    {
        $manufacturer = Manufacturer::find($id);

        $country_ids = [];

        foreach($manufacturer->dealerships as $dealership) {
            $country_ids[] = $dealership->country->id;
        }

        $countries = Country::whereIn('id',$country_ids)->get();

        return $countries;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function manufacturerRegionsApi($id)
    {
        $manufacturer = Manufacturer::find($id);

        return $manufacturer->regions;
    }

}
