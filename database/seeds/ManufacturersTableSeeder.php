<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
        	[
	            'name' => 'Abarth',
	            'url' => 'abarth',
	            //'colour' => 'ff0000',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Alfa Romeo',
	            'url' => 'alfa-romeo',
	            //'colour' => '8f0c25',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Audi',
	            'url' => 'audi',
	            //'colour' => 'bb0a30',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW',
	            'url' => 'bmw',
	            //'colour' => '1c69d4',
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Citroën',
	            'url' => 'citroen',
	            //'colour' => '177d96',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Dacia',
	            'url' => 'dacia',
	            //'colour' => '0073ac',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'DS',
	            'url' => 'ds',
	            //'colour' => '2f2726',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Fiat',
	            'url' => 'fiat',
	            //'colour' => 'ad0c33',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Ford',
	            'url' => 'ford',
	            //'colour' => '2d96cd',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Honda',
	            'url' => 'honda',
	            //'colour' => 'eb1931',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Hyundai',
	            'url' => 'hyundai',
	            //'colour' => '477bbc',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Infiniti',
	            'url' => 'infiniti',
	            //'colour' => '666666',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Jaguar',
	            'url' => 'jaguar',
	            //'colour' => '9e1b32',
	            'company_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Jeep',
	            'url' => 'jeep',
	            //'colour' => 'ffba00',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Kia',
	            'url' => 'kia',
	            //'colour' => 'bc162c',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Land Rover',
	            'url' => 'land-rover',
	            //'colour' => '006936',
	            'company_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Lexus',
	            'url' => 'lexus',
	            //'colour' => '9d8d85',
	            'company_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mazda',
	            'url' => 'mazda',
	            //'colour' => '085f91',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mercedes-Benz',
	            'url' => 'mercedes-benz',
	            //'colour' => '00adef',
	            'company_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'MINI',
	            'url' => 'mini',
	            //'colour' => '0085ac',
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Nissan',
	            'url' => 'nissan',
	            //'colour' => 'c3002f',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel',
	            'url' => 'opel',
	            //'colour' => 'f7d900',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Peugeot',
	            'url' => 'peugeot',
	            //'colour' => '007edb',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Porsche',
	            'url' => 'porsche',
	            //'colour' => '950014',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Renault',
	            'url' => 'renault',
	            //'colour' => 'ffcc33',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'SEAT',
	            'url' => 'seat',
	            //'colour' => 'd81b33',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'ŠKODA',
	            'url' => 'skoda',
	            //'colour' => '4ba82e',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Smart',
	            'url' => 'smart',
	            //'colour' => 'f6ba35',
	            'company_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Suzuki',
	            'url' => 'suzuki',
	            //'colour' => '0582ca',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Toyota',
	            'url' => 'toyota',
	            //'colour' => 'e50000',
	            'company_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Vauxhall',
	            'url' => 'vauxhall',
	            //'colour' => 'be4135',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volkswagen',
	            'url' => 'volkswagen',
	            //'colour' => '00a8ec',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volvo',
	            'url' => 'volvo',
	            //'colour' => '007bcd',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
