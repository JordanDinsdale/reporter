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
	        ]
	    ]);
    }
}
