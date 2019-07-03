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
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => NULL,
	            'manufacturer_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
