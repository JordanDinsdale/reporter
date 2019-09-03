<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Country;
use App\Region;
use App\Group;
use App\Event;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DateTime;

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

        $filename = $manufacturer->name . ' ' . $start_date . ' - ' . $end_date . '.csv';
        $handle = fopen('csv/' . $filename, 'w+');

        fputcsv($handle, 
            array( 
                'Data Count', 
                'Appointments', 
                'New', 
                'Used', 
                'Demo', 
                '0km', 
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
                $manufacturer->data_count, 
                $manufacturer->appointments, 
                $manufacturer->new, 
                $manufacturer->used, 
                $manufacturer->demo, 
                $manufacturer->zero_km, 
                $manufacturer->inprogress
            )
        );

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
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
    public function countryReportDates(Request $request, $country_id, $manufacturer_id)
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

        $filename = $country->manufacturer->name . ' ' . $country->name . ' ' . $start_date . ' - ' . $end_date . '.csv';
        $handle = fopen('csv/' . $filename, 'w+');

        fputcsv($handle, 
            array( 
                'Data Count', 
                'Appointments', 
                'New', 
                'Used', 
                'Demo', 
                '0km', 
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

        fputcsv($handle, 
            array(
                $country->data_count, 
                $country->appointments, 
                $country->new, 
                $country->used, 
                $country->demo, 
                $country->zero_km, 
                $country->inprogress
            )
        );

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
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

        return view('manufacturers.regionless',compact('manufacturer','country'));
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
