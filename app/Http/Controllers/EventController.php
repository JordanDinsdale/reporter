<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

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
            'name' =>'required'
        ]);

        $event = new Event([
            'name' => $request->get('name'),
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

        return view('events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
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
            'name' => 'required'
        ]);

        $event = Event::find($id);
        $event->name = $request->get('name');

        $event->save();

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

        return redirect()->back()->with('success', 'Event Updated');
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
