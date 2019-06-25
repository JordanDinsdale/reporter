<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
        	[
	            'name' => 'Belgium',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'The Netherlands',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Switzerland',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'France',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'United Kingdom',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
