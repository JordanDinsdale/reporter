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

        	// Halliwell Jones Southport BMW

        	[
	            'dealership_id' => 1,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Chester BMW
        	
        	[
	            'dealership_id' => 2,
	            'manufacturer_id' => 4,
	            'region_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Warrington BMW

	        [
	            'dealership_id' => 3,
	            'manufacturer_id' => 4,
	            'region_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones North Wales BMW

	        [
	            'dealership_id' => 4,
	            'manufacturer_id' => 4,
	            'region_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Wilmslow BMW

	        [
	            'dealership_id' => 5,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Southport MINI

	        [
	            'dealership_id' => 6,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Chester MINI

	        [
	            'dealership_id' => 7,
	            'manufacturer_id' => 20,
	            'region_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Warrington MINI

	        [
	            'dealership_id' => 8,
	            'manufacturer_id' => 20,
	            'region_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones North Wales MINI

	        [
	            'dealership_id' => 9,
	            'manufacturer_id' => 20,
	            'region_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Wilmslow MINI

	        [
	            'dealership_id' => 10,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Premium Trade Cars

	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 2,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 3,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 4,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 5,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 6,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 7,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 8,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 10,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 12,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 13,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 14,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 16,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 17,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 18,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 20,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 21,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 23,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 24,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 25,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 26,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Preston BMW

	        [
	            'dealership_id' => 12,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Preston MINI

	        [
	            'dealership_id' => 13,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Blackburn BMW

	        [
	            'dealership_id' => 14,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Blackburn MINI

	        [
	            'dealership_id' => 15,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Ribble Valley

	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 1,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 2,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 4,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 7,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 8,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 12,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 14,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 16,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 18,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 26,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Birmingham Central

	        [
	            'dealership_id' => 17,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Erdington

	        [
	            'dealership_id' => 18,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Macclesfield

	        [
	            'dealership_id' => 19,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Manchester Central

	        [
	            'dealership_id' => 20,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Manchester Used

	        [
	            'dealership_id' => 21,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Solihull

	        [
	            'dealership_id' => 22,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Stockport

	        [
	            'dealership_id' => 23,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Tamworth

	        [
	            'dealership_id' => 24,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Whitefield

	        [
	            'dealership_id' => 25,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Birmingham Central

	        [
	            'dealership_id' => 26,
	            'manufacturer_id' => 28,
	            'region_id' => 13,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Macclesfield

	        [
	            'dealership_id' => 27,
	            'manufacturer_id' => 28,
	            'region_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Manchester Central

	        [
	            'dealership_id' => 28,
	            'manufacturer_id' => 28,
	            'region_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Tamworth

	        [
	            'dealership_id' => 29,
	            'manufacturer_id' => 28,
	            'region_id' => 13,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	    ]);
    }
}
