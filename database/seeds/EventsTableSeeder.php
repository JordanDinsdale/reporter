<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
        	[
	            'name' => 'BMW MINI Event',
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-21',
	            'dealership_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'FCA Group Event',
	            'start_date' => '2019-07-26',
	            'end_date' => '2019-07-28',
	            'dealership_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW VIP Event 2018',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-29',
	            'dealership_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW VIP Event 2019',
	            'start_date' => '2018-07-19',
	            'end_date' => '2018-07-22',
	            'dealership_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
