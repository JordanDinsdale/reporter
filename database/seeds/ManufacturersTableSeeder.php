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
	            'name' => 'Alfa Romeo',
	            'colour' => '8f0c25',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Audi',
	            'colour' => 'bb0a30',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW',
	            'colour' => '1c69d4',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Citroën',
	            'colour' => '177d96',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Dacia',
	            'colour' => '0073ac',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Fiat',
	            'colour' => 'ad0c33',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Ford',
	            'colour' => '2d96cd',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Honda',
	            'colour' => 'eb1931',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Hyundai',
	            'colour' => '477bbc',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Jeep',
	            'colour' => 'ffba00',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Kia',
	            'colour' => 'bc162c',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Land Rover',
	            'colour' => '006936',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mazda',
	            'colour' => '085f91',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Mercedes-Benz',
	            'colour' => '00adef',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'MINI',
	            'colour' => '0085ac',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Nissan',
	            'colour' => 'c3002f',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Peugeot',
	            'colour' => '007edb',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Porsche',
	            'colour' => '950014',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Renault',
	            'colour' => 'ffcc33',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'SEAT',
	            'colour' => 'd81b33',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'ŠKODA',
	            'colour' => '4ba82e',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Smart',
	            'colour' => 'f6ba35',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Suzuki',
	            'colour' => '0582ca',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Toyota',
	            'colour' => 'e50000',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Vauxhall',
	            'colour' => 'be4135',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volkswagen',
	            'colour' => '00a8ec',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volvo',
	            'colour' => '007bcd',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
