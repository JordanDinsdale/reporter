<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DealershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dealerships')->insert([

        	// Halliwell Jones

        	[
	            'name' => 'Halliwell Jones Southport BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Chester BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Warrington BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones North Wales BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Wilmslow BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Southport MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Chester MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Warrington MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones North Wales MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Wilmslow MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Premium Trade Cars',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Motor Group

	        [
	            'name' => 'Bowker Preston BMW',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Preston MINI',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Blackburn BMW',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Blackburn MINI',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Ribble Valley',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH

	        [
	            'name' => 'LSH Mercedes-Benz Birmingham Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Erdington',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Macclesfield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Manchester Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Manchester Used',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Solihull',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Stockport',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Tamworth',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Whitefield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Birmingham Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Macclesfield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Manchester Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Tamworth',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]

	    ]);
    }
}
