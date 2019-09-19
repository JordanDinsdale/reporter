<?php

namespace App\Http\Controllers;

use App\Region;
use App\Manufacturer;
use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class RegionController extends Controller
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
        $regions = Region::orderBy('manufacturer_id')->get();
        $manufacturer_ids = Region::distinct('manufacturer_id')->pluck('manufacturer_id');
        $manufacturers = Manufacturer::whereIn('id',$manufacturer_ids)->get();
        return view('regions.index',compact('regions','manufacturers'));
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
            'region'=>'required',
            'country_id' => 'required',
            'manufacturer_id' => 'required'
        ]);

        $region = new Region([
            'name' => $request->get('region'),
            'country_id' => $request->get('country_id'),
            'manufacturer_id' => $request->get('manufacturer_id')
        ]);

        $region->save();

        return redirect()->back()->with('success', 'Region Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $dealership_ids = [];

        foreach($region->dealerships as $dealership) {

            $dealership_ids[] = $dealership->id;

        }

        $regionEvents = Event::whereIn('dealership_id',$dealership_ids)->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo)->get();

        $region->data_count = 0;
        $region->appointments = 0;
        $region->new = 0;
        $region->used = 0;
        $region->demo = 0;
        $region->zero_km = 0;
        $region->inprogress = 0;

        foreach($regionEvents as $regionEvent) {

            foreach($regionEvent->manufacturers as $regionEventManufacturer) {

                if($regionEventManufacturer->id == $region->manufacturer->id) {

                    $region->data_count += $regionEventManufacturer->pivot->data_count;
                    $region->appointments += $regionEventManufacturer->pivot->appointments;
                    $region->new += $regionEventManufacturer->pivot->new;
                    $region->used += $regionEventManufacturer->pivot->used;
                    $region->demo += $regionEventManufacturer->pivot->demo;
                    $region->zero_km += $regionEventManufacturer->pivot->zero_km;
                    $region->inprogress += $regionEventManufacturer->pivot->inprogress;

                }

            }

        }

        return view('regions.show',compact('region'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function events($id)
    {
        $region = Region::find($id);

        $events_with_data = 0;

        $events_without_data = 0;

        $event_ids = [];

        foreach($region->dealerships as $dealership) {

            if(count($dealership->events) > 0) {

                foreach($dealership->events as $event) {

                    foreach($event->manufacturers as $manufacturer) {

                        if($manufacturer->id == $region->manufacturer->id) {

                            $event_ids[] = $event->id;

                        }

                    }

                }

            }

        }

        $region->events = Event::whereIn('id',$event_ids)->get();

        foreach($region->events as $event) {

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

        return view('regions.events',compact('region','events_with_data','events_without_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function reports($id)
    {

        $region = Region::find($id);

        $event_ids = [];

        foreach($region->dealerships as $dealership) {

            foreach($dealership->events as $event) {

                foreach($event->manufacturers as $manufacturer) {

                    if($manufacturer->id == $region->manufacturer->id) {

                        $event_ids[] = $event->id;

                    }

                }

            }

        }

        $region->events = Event::whereIn('id',$event_ids)->get();

        return view('regions.reports',compact('region'));

    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDates(Request $request, $id)
    {
        $region = Region::find($id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $event_ids = [];

        foreach($region->dealerships as $dealership) {

            foreach($dealership->events as $event) {

                foreach($event->manufacturers as $manufacturer) {

                    if($manufacturer->id == $region->manufacturer->id) {

                        $event_ids[] = $event->id;

                    }

                }

            }

        }

        $region->events = Event::whereIn('id',$event_ids)->get();

        $region->start_date = $start_date;
        $region->end_date = $end_date;        
        $region->data_count = 0;
        $region->appointments = 0;
        $region->new = 0;
        $region->used = 0;
        $region->demo = 0;
        $region->zero_km = 0;
        $region->inprogress = 0;      
        $region->country->data_count = 0;
        $region->country->appointments = 0;
        $region->country->new = 0;
        $region->country->used = 0;
        $region->country->demo = 0;
        $region->country->zero_km = 0;
        $region->country->inprogress = 0;

        $regionDealerships = $region->dealerships;

        foreach($regionDealerships as $regionDealership) {

            foreach($regionDealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $regionDealershipEvent) {

                foreach($regionDealershipEvent->manufacturers as $regionDealershipEventManufacturer) {

                    if($regionDealershipEventManufacturer->id == $region->manufacturer->id) {

                        $region->data_count += $regionDealershipEventManufacturer->pivot->data_count;
                        $region->appointments += $regionDealershipEventManufacturer->pivot->appointments;
                        $region->new += $regionDealershipEventManufacturer->pivot->new;
                        $region->used += $regionDealershipEventManufacturer->pivot->used;
                        $region->demo += $regionDealershipEventManufacturer->pivot->demo;
                        $region->zero_km += $regionDealershipEventManufacturer->pivot->zero_km;
                        $region->inprogress += $regionDealershipEventManufacturer->pivot->inprogress;

                    }

                }

            }

        }

        $countryDealerships = $region->country->dealerships;

        foreach($countryDealerships as $countryDealership) {

            foreach($countryDealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $countryDealershipEvent) {

                foreach($countryDealershipEvent->manufacturers as $countryDealershipEventManufacturer) {

                    if($countryDealershipEventManufacturer->id == $region->manufacturer->id) {

                        $region->country->data_count += $countryDealershipEventManufacturer->pivot->data_count;
                        $region->country->appointments += $countryDealershipEventManufacturer->pivot->appointments;
                        $region->country->new += $countryDealershipEventManufacturer->pivot->new;
                        $region->country->used += $countryDealershipEventManufacturer->pivot->used;
                        $region->country->demo += $countryDealershipEventManufacturer->pivot->demo;
                        $region->country->zero_km += $countryDealershipEventManufacturer->pivot->zero_km;
                        $region->country->inprogress += $countryDealershipEventManufacturer->pivot->inprogress;

                    }

                }

            }

        }

        return view('regions.reportsdate',compact('region'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function download($id,$start_date,$end_date){

        $region = Region::find($id);

        $event_ids = [];

        $filename = $region->manufacturer->name . ' ' . $region->name . ' - ' . $start_date . ' - ' . $end_date . '.csv';

        $handle = fopen('csv/' . $filename, 'w+');

        fputs($handle, "\xEF\xBB\xBF" ); // UTF-8 BOM

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

        foreach($region->dealerships as $dealership) {

            foreach($dealership->events as $event) {

                foreach($event->manufacturers as $manufacturer) {

                    if($manufacturer->id == $region->manufacturer->id) {

                        $event_ids[] = $event->id;

                    }

                }

            }

        }

        $region->events = Event::whereIn('id',$event_ids)->get();

        $region->start_date = $start_date;
        $region->end_date = $end_date;        
        $region->data_count = 0;
        $region->appointments = 0;
        $region->new = 0;
        $region->used = 0;
        $region->demo = 0;
        $region->zero_km = 0;
        $region->inprogress = 0;   

        $regionDealerships = $region->dealerships;

        foreach($regionDealerships as $regionDealership) {

            foreach($regionDealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $regionDealershipEvent) {

                foreach($regionDealershipEvent->manufacturers as $regionDealershipEventManufacturer) {

                    if($regionDealershipEventManufacturer->id == $region->manufacturer->id) {

                        $region->data_count += $regionDealershipEventManufacturer->pivot->data_count;
                        $region->appointments += $regionDealershipEventManufacturer->pivot->appointments;
                        $region->new += $regionDealershipEventManufacturer->pivot->new;
                        $region->used += $regionDealershipEventManufacturer->pivot->used;
                        $region->demo += $regionDealershipEventManufacturer->pivot->demo;
                        $region->zero_km += $regionDealershipEventManufacturer->pivot->zero_km;
                        $region->inprogress += $regionDealershipEventManufacturer->pivot->inprogress;

                    }

                }

            }

        }

        fputcsv($handle, 
            array(
                $region->data_count, 
                $region->appointments, 
                $region->new, 
                $region->used, 
                $region->demo, 
                $region->zero_km, 
                $region->inprogress
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
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'region'=>'required'
        ]);

        $region = Region::find($id);
        $region->name = $request->get('region');

        $region->save();

        return redirect()->back()->with('success', 'Region Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();

        return redirect()->back()->with('success', 'Region Deleted');
    }
}
