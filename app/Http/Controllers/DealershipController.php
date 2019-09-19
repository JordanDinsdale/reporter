<?php

namespace App\Http\Controllers;

use App\Dealership;
use App\Region;
use App\Manufacturer;
use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use DateTime;

class DealershipController extends Controller
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
        //
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
            'dealership'=>'required',
            'country_id' => 'required'
        ]);

        $dealership = new Dealership([
            'name' => $request->get('dealership'),
            'group_id' => $request->get('group_id'),
            'country_id' => $request->get('country_id')
        ]);

        $dealership->save();

        return redirect()->back()->with('success', 'Dealership Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealership = Dealership::find($id);

        $now = new DateTime('now');
        $currentDate = $now->format('Y-m-d');
        $oneYearAgo = $now->modify('-1 year')->format('Y-m-d');

        $dealershipEvents = $dealership->events->where('start_date','<=',$currentDate)->where('end_date','>=',$oneYearAgo);

        $dealership->data_count = 0;
        $dealership->appointments = 0;
        $dealership->new = 0;
        $dealership->used = 0;
        $dealership->demo = 0;
        $dealership->zero_km = 0;
        $dealership->inprogress = 0;

        foreach($dealershipEvents as $dealershipEvent) {

            foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                $dealership->data_count += $dealershipEventManufacturer->pivot->data_count;
                $dealership->appointments += $dealershipEventManufacturer->pivot->appointments;
                $dealership->new += $dealershipEventManufacturer->pivot->new;
                $dealership->used += $dealershipEventManufacturer->pivot->used;
                $dealership->demo += $dealershipEventManufacturer->pivot->demo;
                $dealership->zero_km += $dealershipEventManufacturer->pivot->zero_km;
                $dealership->inprogress += $dealershipEventManufacturer->pivot->inprogress;

            }

        }

        return view('dealerships.show',compact('dealership'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function events($id)
    {
        $dealership = Dealership::find($id);

        $events_with_data = 0;

        $events_without_data = 0;

        if(count($dealership->manufacturers) > 0) {

            foreach($dealership->manufacturers as $manufacturer) {

                if($manufacturer->pivot->region_id) {

                    $manufacturer->region = Region::find($manufacturer->pivot->region_id);

                }

            }

        }

        if(count($dealership->events) > 0) {

            foreach($dealership->events as $event) {

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

        }

        $manufacturers = Manufacturer::orderBy('name')->get();

        return view('dealerships.events',compact('dealership','manufacturers','events_with_data','events_without_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function reports($id)
    {
        $dealership = Dealership::find($id);

        $event = $dealership->events->sortByDesc('end_date')->first();

        $dealership->data_count = 0;
        $dealership->appointments = 0;
        $dealership->new = 0;
        $dealership->used = 0;
        $dealership->demo = 0;
        $dealership->zero_km = 0;
        $dealership->inprogress = 0;

        foreach($event->manufacturers as $manufacturer) {

            $dealership->data_count += $manufacturer->pivot->data_count;
            $dealership->appointments += $manufacturer->pivot->appointments;
            $dealership->new += $manufacturer->pivot->new;
            $dealership->used += $manufacturer->pivot->used;
            $dealership->demo += $manufacturer->pivot->demo;
            $dealership->zero_km += $manufacturer->pivot->zero_km;
            $dealership->inprogress += $manufacturer->pivot->inprogress;

            $region_id = DB::table('dealership_manufacturer')->where('dealership_id',$dealership->id)->where('manufacturer_id',$manufacturer->id)->pluck('region_id');

            $manufacturer->region = Region::find($region_id);
            $manufacturer->region_data_count = 0;
            $manufacturer->region_appointments = 0;
            $manufacturer->region_new = 0;
            $manufacturer->region_used = 0;
            $manufacturer->region_demo = 0;
            $manufacturer->region_zero_km = 0;
            $manufacturer->region_inprogress = 0;

            $manufacturer->country = $event->dealership->country;
            $manufacturer->country_data_count = 0;
            $manufacturer->country_appointments = 0;
            $manufacturer->country_new = 0;
            $manufacturer->country_used = 0;
            $manufacturer->country_demo = 0;
            $manufacturer->country_zero_km = 0;
            $manufacturer->country_inprogress = 0;

            if($region_id) {

                $region_event_ids = [];

                $region_dealership_ids = DB::table('dealership_manufacturer')->where('region_id',$region_id)->pluck('dealership_id');

                foreach($region_dealership_ids as $region_dealership_id) {

                    $region_dealership = Dealership::find($region_dealership_id);

                    foreach($region_dealership->events as $regionEvent) {

                        $region_event_ids[] = $regionEvent->id;

                    }

                }

                $manufacturer->region_data_count = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');

                $manufacturer->region_appointments = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');

                $manufacturer->region_new = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');

                $manufacturer->region_used = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');

                $manufacturer->region_demo = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');

                $manufacturer->region_zero_km = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');

                $manufacturer->region_inprogress = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

            }

            $country_event_ids = [];

            $country_dealership_ids = Dealership::where('country_id',$dealership->country->id)->pluck('id');

            foreach($country_dealership_ids as $country_dealership_id) {

                $country_dealership = Dealership::find($country_dealership_id);

                foreach($country_dealership->events as $countryEvent) {

                    $country_event_ids[] = $countryEvent->id;

                }

            }

            $manufacturer->country_data_count = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');

            $manufacturer->country_appointments = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');

            $manufacturer->country_new = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');

            $manufacturer->country_used = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');

            $manufacturer->country_demo = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');

            $manufacturer->country_zero_km = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');

            $manufacturer->country_inprogress = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

        }

        return view('dealerships.reports',compact('dealership','event'));

    }

    /**
     * Show event data between the given dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDates(Request $request, $id)
    {
        $dealership = Dealership::find($id);

        $start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
        $end_date = $end_date->format('Y-m-d');

        $dealershipEvents = $dealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date);

        $dealership->start_date = $start_date;
        $dealership->end_date = $end_date;        
        $dealership->data_count = 0;
        $dealership->appointments = 0;
        $dealership->new = 0;
        $dealership->used = 0;
        $dealership->demo = 0;
        $dealership->zero_km = 0;
        $dealership->inprogress = 0;

        $manufacturers = [];
        $event_ids = [];
        $manufacturer_ids = [];

        foreach($dealershipEvents as $dealershipEvent) {

            $event_ids[] = $dealershipEvent->id;

            foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                $manufacturer_ids[] = $dealershipEventManufacturer->id;

                $dealership->data_count += $dealershipEventManufacturer->pivot->data_count;
                $dealership->appointments += $dealershipEventManufacturer->pivot->appointments;
                $dealership->new += $dealershipEventManufacturer->pivot->new;
                $dealership->used += $dealershipEventManufacturer->pivot->used;
                $dealership->demo += $dealershipEventManufacturer->pivot->demo;
                $dealership->zero_km += $dealershipEventManufacturer->pivot->zero_km;
                $dealership->inprogress += $dealershipEventManufacturer->pivot->inprogress;

            }

        }

        $manufacturer_ids = array_unique($manufacturer_ids);

        foreach($manufacturer_ids as $manufacturer_id) {

            $manufacturer = Manufacturer::find($manufacturer_id);

            $manufacturer->data_count = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');
            
            $manufacturer->appointments = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');
            
            $manufacturer->new = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');
            
            $manufacturer->used = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');
            
            $manufacturer->demo = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');
            
            $manufacturer->zero_km = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');
            
            $manufacturer->inprogress = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

            $region_id = DB::table('dealership_manufacturer')->where('dealership_id',$dealership->id)->where('manufacturer_id',$manufacturer->id)->pluck('region_id');

            if($region_id) {

                $region_event_ids = [];

                $region_dealership_ids = DB::table('dealership_manufacturer')->where('region_id',$region_id)->pluck('dealership_id');

                foreach($region_dealership_ids as $region_dealership_id) {

                    $region_dealership = Dealership::find($region_dealership_id);

                    foreach($region_dealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $event) {

                        $region_event_ids[] = $event->id;

                    }

                }

                $manufacturer->region_data_count = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');

                $manufacturer->region_appointments = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');

                $manufacturer->region_new = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');

                $manufacturer->region_used = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');

                $manufacturer->region_demo = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');

                $manufacturer->region_zero_km = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');

                $manufacturer->region_inprogress = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

            }

            $country_event_ids = [];

            $country_dealership_ids = Dealership::where('country_id',$dealership->country->id)->pluck('id');

            foreach($country_dealership_ids as $country_dealership_id) {

                $country_dealership = Dealership::find($country_dealership_id);

                foreach($country_dealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date) as $event) {

                    $country_event_ids[] = $event->id;

                }

            }

            $manufacturer->country_data_count = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');

            $manufacturer->country_appointments = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');

            $manufacturer->country_new = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');

            $manufacturer->country_used = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');

            $manufacturer->country_demo = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');

            $manufacturer->country_zero_km = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');

            $manufacturer->country_inprogress = DB::table('event_manufacturer')->whereIn('event_id',$country_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

            $manufacturers[] = $manufacturer;

        }

        usort($manufacturers, function ($item1, $item2) {
            return $item1['url'] <=> $item2['url'];
        });

        $dealership->manufacturers = $manufacturers;

        return view('dealerships.reportsdate',compact('dealership'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dealership = Dealership::find($id);
        return view('dealerships.edit', compact('dealership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dealership'=>'required'
        ]);

        $dealership = Dealership::find($id);
        $dealership->name = $request->get('dealership');

        $dealership->save();

        return redirect()->back()->with('success', 'Dealership Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dealership  $dealership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealership = Dealership::find($id);
        $dealership->delete();

        return redirect()->back()->with('success', 'Dealership Deleted');
    }

    /**
     * Attach a manufacturer with region if one has been provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachManufacturer(Request $request)
    {
        $request->validate([
            'dealership_id'=>'required',
            'manufacturer_id' => 'required'
        ]);

        $dealership_id = $request->get('dealership_id');
        $manufacturer_id = $request->get('manufacturer_id');
        $region_id = $request->get('region_id');

        $dealership = Dealership::find($dealership_id);

        $dealership->manufacturers()->attach($manufacturer_id, array('region_id' => $region_id));

        return redirect()->back()->with('success', 'Manufacturer Added');
    }

    /**
     * Attach a manufacturer with region if one has been provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detachManufacturer(Request $request)
    {
        $request->validate([
            'dealership_id'=>'required',
            'manufacturer_id' => 'required'
        ]);

        $dealership_id = $request->get('dealership_id');
        $manufacturer_id = $request->get('manufacturer_id');

        $dealership = Dealership::find($dealership_id);

        $dealership->manufacturers()->detach($manufacturer_id);

        return redirect()->back()->with('success', 'Manufacturer Removed');
    }

    /**
     * Attach a manufacturer with region if one has been provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRegion(Request $request)
    {
        $request->validate([
            'dealership_id'=>'required',
            'manufacturer_id' => 'required'
        ]);

        $dealership_id = $request->get('dealership_id');
        $manufacturer_id = $request->get('manufacturer_id');
        $region_id = $request->get('region_id');

        $dealership = Dealership::find($dealership_id);

        $dealership->manufacturers()->sync(
            [
                $manufacturer_id => [
                    'region_id' => $region_id
                ]
            ],false
        );

        return redirect()->back()->with('success', 'Region Updated');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function download($id,$start_date,$end_date){

        $dealership = Dealership::find($id);

        $dealershipEvents = $dealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date);

        $start_date = Carbon::parse($start_date)->format('d-m-Y');
        $end_date = Carbon::parse($end_date)->format('d-m-Y');

        $filename = $dealership->name . ' ' . $start_date . ' - ' . $end_date . '.csv';

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

        $dealership->data_count = 0;
        $dealership->appointments = 0;
        $dealership->new = 0;
        $dealership->used = 0;
        $dealership->demo = 0;
        $dealership->zero_km = 0;
        $dealership->inprogress = 0;

        $manufacturers = [];
        $event_ids = [];
        $manufacturer_ids = [];

        foreach($dealershipEvents as $dealershipEvent) {

            $event_ids[] = $dealershipEvent->id;

            foreach($dealershipEvent->manufacturers as $dealershipEventManufacturer) {

                $manufacturer_ids[] = $dealershipEventManufacturer->id;

                $dealership->data_count += $dealershipEventManufacturer->pivot->data_count;
                $dealership->appointments += $dealershipEventManufacturer->pivot->appointments;
                $dealership->new += $dealershipEventManufacturer->pivot->new;
                $dealership->used += $dealershipEventManufacturer->pivot->used;
                $dealership->demo += $dealershipEventManufacturer->pivot->demo;
                $dealership->zero_km += $dealershipEventManufacturer->pivot->zero_km;
                $dealership->inprogress += $dealershipEventManufacturer->pivot->inprogress;

            }

        }

        $manufacturer_ids = array_unique($manufacturer_ids);

        $manufacturers = Manufacturer::whereIn('id',$manufacturer_ids)->orderBy('name')->get();

        foreach($manufacturers as $manufacturer) {

            $manufacturer->data_count = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');
            
            $manufacturer->appointments = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');
            
            $manufacturer->new = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');
            
            $manufacturer->used = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');
            
            $manufacturer->demo = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');
            
            $manufacturer->zero_km = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');
            
            $manufacturer->inprogress = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

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
                $dealership->data_count, 
                $dealership->appointments, 
                $dealership->new, 
                $dealership->used, 
                $dealership->demo, 
                $dealership->zero_km, 
                $dealership->inprogress
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function downloadManufacturer($dealership_id,$manufacturer_id,$start_date,$end_date){

        $dealership = Dealership::find($dealership_id);

        $manufacturer = Manufacturer::find($manufacturer_id);

        $dealershipEvents = $dealership->events->where('start_date','<=',$end_date)->where('end_date','>=',$start_date);

        $filename = $dealership->name . ' - ' . $manufacturer->name . ' ' . $start_date . ' - ' . $end_date . '.csv';

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

        foreach($dealershipEvents as $dealershipEvent) {

            $event_ids[] = $dealershipEvent->id;

        }

        $manufacturer->data_count = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');
            
        $manufacturer->appointments = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');
        
        $manufacturer->new = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');
        
        $manufacturer->used = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');
        
        $manufacturer->demo = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');
        
        $manufacturer->zero_km = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');
        
        $manufacturer->inprogress = DB::table('event_manufacturer')->whereIn('event_id',$event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

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
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8'
        );

        return response()->download('csv/' . $filename, $filename, $headers);

    }

}
