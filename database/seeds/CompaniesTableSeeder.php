<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
        	[
	            'name' => 'FCA Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Volkswagen Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'PSA Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'BMW Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Renault Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'JLR Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Toyota Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Daimler Group',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
