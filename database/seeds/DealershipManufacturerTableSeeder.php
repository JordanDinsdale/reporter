<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DealershipManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dealership_manufacturer')->insert([
        	[
	            'dealership_id' => 1,
	            'manufacturer_id' => 3,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 2,
	            'manufacturer_id' => 3,
	            'region_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 3,
	            'manufacturer_id' => 3,
	            'region_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 4,
	            'manufacturer_id' => 3,
	            'region_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 5,
	            'manufacturer_id' => 3,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 6,
	            'manufacturer_id' => 15,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 7,
	            'manufacturer_id' => 15,
	            'region_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 8,
	            'manufacturer_id' => 15,
	            'region_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 9,
	            'manufacturer_id' => 15,
	            'region_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 10,
	            'manufacturer_id' => 15,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        /*
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 13,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 19,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 21,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 23,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 24,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 25,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 26,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 27,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        */
	        [
	            'dealership_id' => 12,
	            'manufacturer_id' => 3,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 13,
	            'manufacturer_id' => 15,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 14,
	            'manufacturer_id' => 3,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 15,
	            'manufacturer_id' => 15,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        /*
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 26,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 27,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	        */
	    ]);
    }
}
