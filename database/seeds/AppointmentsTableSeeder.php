<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
        	[
	            'firstname' => 'BMW Appointment',
	            'surname' => 'One',
	            'sale' => NULL,
	            'sales_executive_id' => 2,
	            'manufacturer_id' => 3,
	            'region_id' => 1,
	            'created_by_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	        
        	[
	            'firstname' => 'MINI Appointment',
	            'surname' => 'One',
	            'sale' => NULL,
	            'sales_executive_id' => 3,
	            'manufacturer_id' => 15,
	            'region_id' => 5,
	            'created_by_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	        
        	[
	            'firstname' => 'MINI Appointment',
	            'surname' => 'Two',
	            'sale' => NULL,
	            'sales_executive_id' => 4,
	            'manufacturer_id' => 15,
	            'region_id' => 6,
	            'created_by_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
