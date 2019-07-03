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
	            'colour' => 'ff0000',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Alfa Romeo',
	            'colour' => '8f0c25',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Audi',
	            'colour' => 'bb0a30',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW',
	            'colour' => '1c69d4',
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Citroën',
	            'colour' => '177d96',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Dacia',
	            'colour' => '0073ac',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'DS',
	            'colour' => '2f2726',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Fiat',
	            'colour' => 'ad0c33',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Ford',
	            'colour' => '2d96cd',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Honda',
	            'colour' => 'eb1931',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Hyundai',
	            'colour' => '477bbc',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Infiniti',
	            'colour' => '666666',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Jaguar',
	            'colour' => '9e1b32',
	            'company_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Jeep',
	            'colour' => 'ffba00',
	            'company_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Kia',
	            'colour' => 'bc162c',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Land Rover',
	            'colour' => '006936',
	            'company_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Lexus',
	            'colour' => '9d8d85',
	            'company_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mazda',
	            'colour' => '085f91',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mercedes-Benz',
	            'colour' => '00adef',
	            'company_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'MINI',
	            'colour' => '0085ac',
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Nissan',
	            'colour' => 'c3002f',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel',
	            'colour' => 'f7d900',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Peugeot',
	            'colour' => '007edb',
	            'company_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Porsche',
	            'colour' => '950014',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Renault',
	            'colour' => 'ffcc33',
	            'company_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'SEAT',
	            'colour' => 'd81b33',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'ŠKODA',
	            'colour' => '4ba82e',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Smart',
	            'colour' => 'f6ba35',
	            'company_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Suzuki',
	            'colour' => '0582ca',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Toyota',
	            'colour' => 'e50000',
	            'company_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Vauxhall',
	            'colour' => 'be4135',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volkswagen',
	            'colour' => '00a8ec',
	            'company_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volvo',
	            'colour' => '007bcd',
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
