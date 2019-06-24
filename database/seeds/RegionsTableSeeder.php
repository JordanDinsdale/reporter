<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
        	[
	            'name' => 'North UK',
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'East UK',
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South UK',
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'West UK',
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'North East UK',
	            'manufacturer_id' => 15,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South East UK',
	            'manufacturer_id' => 15,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South West UK',
	            'manufacturer_id' => 15,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'North West UK',
	            'manufacturer_id' => 15,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
