<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'firstname' => 'Jordan',
	            'surname' => 'Dinsdale',
	            'email' => 'jordan.dinsdale@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Admin',
	            'dealership_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	        
        	[
	            'firstname' => 'Sales',
	            'surname' => 'Executive',
	            'email' => 'sales.executive@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Sales Executive',
	            'dealership_id' => 1,
	            'region_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
