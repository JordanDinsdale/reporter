<?php

namespace App\Http\Controllers;

use App\Region;
use App\Manufacturer;
use App\Country;
use App\Dealership;
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

        $regionManufacturers = Manufacturer::whereIn('id',$manufacturer_ids)->get();

        $manufacturers = Manufacturer::orderBy('name')->get();

        $countries = Country::orderBy('name')->get();

        return view('regions.index',compact('regions','regionManufacturers','manufacturers','countries'));
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
            'name'=>'required',
            'country_id' => 'required',
            'manufacturer_id' => 'required'
        ]);

        $region = new Region([
            'name' => $request->get('name'),
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

        $level = $request->level;

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

        if($level == 'Region') {

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

        }

        if($level == 'Dealership') {

            $region->dealership = Dealership::find($request->dealership_id);

            foreach($regionDealerships as $regionDealership) {

                foreach($regionDealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $regionDealershipEvent) {

                    foreach($regionDealershipEvent->manufacturers as $regionDealershipEventManufacturer) {

                        if($regionDealershipEventManufacturer->id == $region->manufacturer->id) {

                            if($regionDealership->id == $region->dealership->id) {

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

            $region->region = Region::find($id);
            $region->region->data_count = 0;
            $region->region->appointments = 0;
            $region->region->new = 0;
            $region->region->used = 0;
            $region->region->demo = 0;
            $region->region->zero_km = 0;
            $region->region->inprogress = 0;

            foreach($regionDealerships as $regionDealership) {

                foreach($regionDealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $regionDealershipEvent) {

                    foreach($regionDealershipEvent->manufacturers as $regionDealershipEventManufacturer) {

                        if($regionDealershipEventManufacturer->id == $region->manufacturer->id) {

                            $region->region->data_count += $regionDealershipEventManufacturer->pivot->data_count;
                            $region->region->appointments += $regionDealershipEventManufacturer->pivot->appointments;
                            $region->region->new += $regionDealershipEventManufacturer->pivot->new;
                            $region->region->used += $regionDealershipEventManufacturer->pivot->used;
                            $region->region->demo += $regionDealershipEventManufacturer->pivot->demo;
                            $region->region->zero_km += $regionDealershipEventManufacturer->pivot->zero_km;
                            $region->region->inprogress += $regionDealershipEventManufacturer->pivot->inprogress;

                        }

                    }

                }

            }

        }

        return view('regions.reportsdate',compact('region','level'));

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

        $formatted_start_date = Carbon::createFromFormat('Y-m-d',$start_date);
        $formatted_start_date = $formatted_start_date->format('d-m-Y');

        $formatted_end_date = Carbon::createFromFormat('Y-m-d',$end_date);
        $formatted_end_date = $formatted_end_date->format('d-m-Y');

        $filename = 'Rhino Events_' . $region->manufacturer->name . ' ' . $region->country->name . ' ' . $region->name . '_' . $formatted_start_date . ' - ' . $formatted_end_date . '.csv';

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

                        $event_data = [];

                        $event_data[] = $regionDealershipEvent->name;
                        $event_data[] = $regionDealershipEventManufacturer->pivot->data_count;
                        $event_data[] = $regionDealershipEventManufacturer->pivot->appointments;
                        if($regionDealershipEventManufacturer->pivot->appointments > 0) {
                            $event_data[] = number_format($regionDealershipEventManufacturer->pivot->appointments/$regionDealershipEventManufacturer->pivot->data_count * 100, 2, '.', ',') . '%';
                        }
                        else {
                            $event_data[] = '0%';
                        }
                        $event_data[] = $regionDealershipEventManufacturer->pivot->new;
                        $event_data[] = $regionDealershipEventManufacturer->pivot->used;
                        $event_data[] = $regionDealershipEventManufacturer->pivot->demo;
                        $event_data[] = $regionDealershipEventManufacturer->pivot->zero_km;
                        if($regionDealershipEventManufacturer->pivot->appointments > 0) {
                            $event_data[] = number_format(($regionDealershipEventManufacturer->pivot->new + $regionDealershipEventManufacturer->pivot->used + $regionDealershipEventManufacturer->pivot->demo + $regionDealershipEventManufacturer->pivot->zero_km)/$regionDealershipEventManufacturer->pivot->appointments * 100, 2, '.', ',') . '%';
                        }
                        else {
                            $event_data[] = '0%';
                        }
                        $event_data[] = $regionDealershipEventManufacturer->pivot->inprogress;

                        fputcsv($handle, $event_data);

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

        $total_event_data = ['Total'];

        $total_event_data[] = $region->data_count;
        $total_event_data[] = $region->appointments;
        if($region->appointments > 0) {
            $total_event_data[] = number_format($region->appointments/$region->data_count * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $region->new;
        $total_event_data[] = $region->used;
        $total_event_data[] = $region->demo;
        $total_event_data[] = $region->zero_km;
        if($region->appointments > 0) {
            $total_event_data[] = number_format(($region->new + $region->used + $region->demo + $region->zero_km)/$region->appointments * 100, 2, '.', ',') . '%';
        }
        else {
            $total_event_data[] = '0%';
        }
        $total_event_data[] = $region->inprogress;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function regionDealershipsApi($id)
    {
        $region = Region::find($id);

        return $region->dealerships;
    }

}
