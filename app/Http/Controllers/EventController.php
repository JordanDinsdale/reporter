<?php

namespace App\Http\Controllers;

use App\Event;
use App\Dealership;
use App\Region;
use App\Manufacturer;
use App\Company;
use Illuminate\Http\Request;
use DB;

class EventController extends Controller
{
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
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manufacturer_ids' => 'required'
        ]);

        $event = new Event([
            'name' => $request->get('name'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'dealership_id' => $request->get('dealership_id')
        ]);

        $event->save();

        $manufacturer_ids = $request->get('manufacturer_ids');

        foreach($manufacturer_ids as $manufacturer_id) {

            $event->manufacturers()->sync(
                [
                    $manufacturer_id => [
                        'data_count' => '0',
                        'appointments' => '0',
                        'new' => '0',
                        'used' => '0',
                        'zero_km' => '0',
                        'demo' => '0',
                        'inprogress' => '0'
                    ]
                ],false
            );

        }

        return redirect()->back()->with('success', 'Event Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        $event_manufacturer_ids = [];

        $event->data_count = 0;
        $event->appointments = 0;
        $event->new = 0;
        $event->used = 0;
        $event->demo = 0;
        $event->zero_km = 0;
        $event->inprogress = 0;

        if(count($event->manufacturers) > 0) {

            foreach($event->manufacturers as $manufacturer) {

                foreach($event->dealership->manufacturers as $dealershipManufacturer) {

                    if($dealershipManufacturer->id == $manufacturer->id) {

                        $manufacturer->region = Region::find($dealershipManufacturer->pivot->region_id);
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

                        if($manufacturer->region) {

                            foreach($manufacturer->region->dealerships as $dealership) {

                                foreach($dealership->events as $dealershipEvent) {

                                    foreach($dealershipEvent->manufacturers as $eventManufacturer) {

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

                        }

                        foreach($manufacturer->country->dealerships as $dealership) {

                            foreach($dealership->events as $dealershipEvent) {

                                foreach($dealershipEvent->manufacturers as $eventManufacturer) {

                                    if($eventManufacturer->id == $manufacturer->id) {

                                        $manufacturer->country_data_count += $eventManufacturer->pivot->data_count;
                                        $manufacturer->country_appointments += $eventManufacturer->pivot->appointments;
                                        $manufacturer->country_new += $eventManufacturer->pivot->new;
                                        $manufacturer->country_used += $eventManufacturer->pivot->used;
                                        $manufacturer->country_demo += $eventManufacturer->pivot->demo;
                                        $manufacturer->country_zero_km += $eventManufacturer->pivot->zero_km;
                                        $manufacturer->country_inprogress += $eventManufacturer->pivot->inprogress;

                                    }

                                }

                            }

                        }

                    }

                }

                $event_manufacturer_ids[] = $manufacturer->id;

                $event->data_count += $manufacturer->pivot->data_count;
                $event->appointments += $manufacturer->pivot->appointments;
                $event->new += $manufacturer->pivot->new;
                $event->used += $manufacturer->pivot->used;
                $event->demo += $manufacturer->pivot->demo;
                $event->zero_km += $manufacturer->pivot->zero_km;
                $event->inprogress += $manufacturer->pivot->inprogress;

            }

        }

        return view('events.show',compact('event','event_manufacturer_ids'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function company($event_id,$company_id)
    {
        $event = Event::find($event_id);
        $company = Company::find($company_id);

        $manufacturer_ids = [];

        if(count($company->manufacturers) > 0) {
            foreach($company->manufacturers as $manufacturer) {
                $manufacturer_ids[] = $manufacturer->id;
            }
        }

        $event_manufacturer_ids = [];

        if(count($event->manufacturers) > 0) {
            foreach($event->manufacturers as $manufacturer) {
                $event_manufacturer_ids[] = $manufacturer->id;
            }
        }

        return view('events.company',compact('event','event_manufacturer_ids','manufacturer_ids'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function manufacturer($event_id,$manufacturer_id)
    {
        $event = Event::find($event_id);

        $manufacturer = Manufacturer::find($manufacturer_id);

        $region_id = DB::table('dealership_manufacturer')->where('dealership_id',$event->dealership->id)->where('manufacturer_id',$manufacturer->id)->value('region_id');

        $manufacturer->region = Region::find($region_id);
        $manufacturer->region_data_count = 0;
        $manufacturer->region_appointments = 0;
        $manufacturer->region_new = 0;
        $manufacturer->region_used = 0;
        $manufacturer->region_demo = 0;
        $manufacturer->region_zero_km = 0;
        $manufacturer->region_inprogress = 0;

        $region = Region::find($region_id);

        if($region_id) {

            $region_event_ids = [];

            $region_dealership_ids = DB::table('dealership_manufacturer')->where('region_id',$region_id)->pluck('dealership_id');

            foreach($region_dealership_ids as $region_dealership_id) {

                $region_dealership = Dealership::find($region_dealership_id);

                foreach($region_dealership->events as $regionEvent) {

                    foreach($regionEvent->manufacturers as $regionEventManufacturer) {

                        if($regionEventManufacturer->id == $manufacturer->id) {

                            $region_event_ids[] = $regionEvent->id;

                        }

                    }

                }

            }

            $region->events = Event::whereIn('id',$region_event_ids)->get();

            $manufacturer->region_data_count = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('data_count');

            $manufacturer->region_appointments = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('appointments');

            $manufacturer->region_new = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('new');

            $manufacturer->region_used = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('used');

            $manufacturer->region_demo = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('demo');

            $manufacturer->region_zero_km = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('zero_km');

            $manufacturer->region_inprogress = DB::table('event_manufacturer')->whereIn('event_id',$region_event_ids)->where('manufacturer_id',$manufacturer->id)->sum('inprogress');

        }

        $country_event_ids = [];

        $country_dealership_ids = Dealership::where('country_id',$event->dealership->country->id)->pluck('id');

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

        return view('events.manufacturer',compact('region','manufacturer','event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        return view('events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manufacturer_ids' => 'required'
        ]);

        $event = Event::find($id);
        $event->name = $request->get('name');
        $event->start_date = $request->get('start_date');
        $event->end_date = $request->get('end_date');

        $event->save();

        $event_manufacturer_ids = [];

        if(count($event->manufacturers) > 0) {
            foreach($event->manufacturers as $manufacturer) {
                $event_manufacturer_ids[] = $manufacturer->id;
            }
        }

        $manufacturer_ids = $request->get('manufacturer_ids');

        if(count($manufacturer_ids) > 0) {

            foreach($manufacturer_ids as $manufacturer_id) {

                if(!in_array($manufacturer_id,$event_manufacturer_ids)) {

                    $event->manufacturers()->sync(
                        [
                            $manufacturer_id => [
                                'data_count' => '0',
                                'appointments' => '0',
                                'new' => '0',
                                'used' => '0',
                                'zero_km' => '0',
                                'demo' => '0',
                                'inprogress' => '0'
                            ]
                        ],false
                    );

                }

            }

        }

        if(count($event_manufacturer_ids) > 0) {

            foreach($event_manufacturer_ids as $event_manufacturer_id) {

                if(!in_array($event_manufacturer_id,$manufacturer_ids)) {

                    $event->manufacturers()->detach($event_manufacturer_id);

                }

            }

        }

        return redirect()->back()->with('success', 'Event Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function updateSync(Request $request, $event_id, $manufacturer_id)
    {
        $request->validate([
            'data_count' => 'required'
        ]);

        $event = Event::find($event_id);
        
        $event->manufacturers()->sync(
            [
                $manufacturer_id => [
                    'data_count' => $request->get('data_count'),
                    'appointments' => $request->get('appointments'),
                    'new' => $request->get('new'),
                    'used' => $request->get('used'),
                    'zero_km' => $request->get('zero_km'),
                    'demo' => $request->get('demo'),
                    'inprogress' => $request->get('inprogress')
                ]
            ],false
        );

        return redirect()->back()->with([
            'success' => 'Event Updated',
            'manufacturer_id' => $manufacturer_id
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function download($id){

        $event = Event::find($id);
        $filename = $event->name . '.csv';
        $handle = fopen('csv/' . $filename, 'w+');

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

        $total_data_count = 0;
        $total_appointments = 0;
        $total_new = 0;
        $total_used = 0;
        $total_demo = 0;
        $total_zero_km = 0;
        $total_inprogress = 0;

        foreach($event->manufacturers as $manufacturer) {

            fputcsv($handle, 
                array(
                    $manufacturer->name, 
                    $manufacturer->pivot->data_count, 
                    $manufacturer->pivot->appointments, 
                    $manufacturer->pivot->new, 
                    $manufacturer->pivot->used, 
                    $manufacturer->pivot->demo, 
                    $manufacturer->pivot->zero_km, 
                    $manufacturer->pivot->inprogress
                )
            );

            $total_data_count += $manufacturer->pivot->data_count;
            $total_appointments += $manufacturer->pivot->appointments;
            $total_new += $manufacturer->pivot->new;
            $total_used += $manufacturer->pivot->used;
            $total_demo += $manufacturer->pivot->demo;
            $total_zero_km += $manufacturer->pivot->zero_km;
            $total_inprogress += $manufacturer->pivot->inprogress;

        }

        fputcsv($handle, 
            array(
                'Total', 
                $total_data_count, 
                $total_appointments, 
                $total_new, 
                $total_used, 
                $total_demo, 
                $total_zero_km, 
                $total_inprogress
            )
        );

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
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
    public function downloadManufacturer($event_id, $manufacturer_id){

        $event = Event::find($event_id);
        $manufacturer = Manufacturer::find($manufacturer_id);
        $filename = $event->name . ' - ' . $manufacturer->name . '.csv';

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

        foreach($event->manufacturers as $manufacturer) {

            if($manufacturer->id == $manufacturer_id) {

                fputcsv($handle, 
                    array(
                        $manufacturer->pivot->data_count, 
                        $manufacturer->pivot->appointments, 
                        $manufacturer->pivot->new, 
                        $manufacturer->pivot->used, 
                        $manufacturer->pivot->demo, 
                        $manufacturer->pivot->zero_km, 
                        $manufacturer->pivot->inprogress
                    )
                );

            }

        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download('csv/' . $filename, $filename, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
