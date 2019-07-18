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

        	// BMW UK

        	[
	            'name' => 'North UK',
	            'manufacturer_id' => 4,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'East UK',
	            'manufacturer_id' => 4,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South UK',
	            'manufacturer_id' => 4,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'West UK',
	            'manufacturer_id' => 4,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // MINI UK

	        [
	            'name' => 'North East UK',
	            'manufacturer_id' => 20,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South East UK',
	            'manufacturer_id' => 20,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'South West UK',
	            'manufacturer_id' => 20,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'North West UK',
	            'manufacturer_id' => 20,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // MINI France

	        [
	            'name' => 'Northern France',
	            'manufacturer_id' => 4,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Mercedes-Benz UK

	        [
	            'name' => 'North West',
	            'manufacturer_id' => 19,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'East Midlands',
	            'manufacturer_id' => 19,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Smart UK

	        [
	            'name' => 'North West',
	            'manufacturer_id' => 28,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'East Midlands',
	            'manufacturer_id' => 28,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Abarth Switzerland

	        [
	            'name' => 'Central Swtizerland',
	            'manufacturer_id' => 1,
	            'country_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Ford Belgium

	        [
	            'name' => 'North',
	            'manufacturer_id' => 9,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 1

	        [
	            'name' => '01',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 2

	        [
	            'name' => '02',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 3

	        [
	            'name' => '03',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 4

	        [
	            'name' => '04',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 5

	        [
	            'name' => '05',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 6

	        [
	            'name' => '06',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 7

	        [
	            'name' => '07',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 8

	        [
	            'name' => '08',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 9

	        [
	            'name' => '09',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 10

	        [
	            'name' => '10',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 11

	        [
	            'name' => '11',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel 12

	        [
	            'name' => '12',
	            'manufacturer_id' => 22,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]

	    ]);
    }
}
