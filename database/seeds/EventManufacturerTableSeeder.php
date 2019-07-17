<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_manufacturer')->insert([

        	// BMW MINI Event

        	[
	            'event_id' => 1,
	            'manufacturer_id' => 4,
	            'data_count' => 4000,
	            'appointments' => 500,
	            'new' => 50,
	            'used' => 30,
	            'zero_km' => 10,
	            'demo' => 5,
	            'inprogress' => 3
	        ],
        	[
	            'event_id' => 1,
	            'manufacturer_id' => 20,
	            'data_count' => 3000,
	            'appointments' => 400,
	            'new' => 30,
	            'used' => 20,
	            'zero_km' => 5,
	            'demo' => 3,
	            'inprogress' => 2
	        ],

        	// FCA Group Event

        	[
	            'event_id' => 2,
	            'manufacturer_id' => 1,
	            'data_count' => 3600,
	            'appointments' => 600,
	            'new' => 30,
	            'used' => 10,
	            'zero_km' => 9,
	            'demo' => 6,
	            'inprogress' => 3
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 2,
	            'data_count' => 2400,
	            'appointments' => 400,
	            'new' => 20,
	            'used' => 15,
	            'zero_km' => 12,
	            'demo' => 9,
	            'inprogress' => 2
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 8,
	            'data_count' => 4200,
	            'appointments' => 500,
	            'new' => 40,
	            'used' => 35,
	            'zero_km' => 32,
	            'demo' => 19,
	            'inprogress' => 12
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 14,
	            'data_count' => 2200,
	            'appointments' => 300,
	            'new' => 32,
	            'used' => 18,
	            'zero_km' => 10,
	            'demo' => 15,
	            'inprogress' => 4
	        ],

	        // BMW VIP Event 2018

        	[
	            'event_id' => 3,
	            'manufacturer_id' => 4,
	            'data_count' => 1800,
	            'appointments' => 120,
	            'new' => 22,
	            'used' => 32,
	            'zero_km' => 8,
	            'demo' => 4,
	            'inprogress' => 4
	        ],

	        // BMW VIP Event 2019

        	[
	            'event_id' => 4,
	            'manufacturer_id' => 4,
	            'data_count' => 2200,
	            'appointments' => 140,
	            'new' => 32,
	            'used' => 41,
	            'zero_km' => 15,
	            'demo' => 5,
	            'inprogress' => 2
	        ],

	    ]);
    }
}
