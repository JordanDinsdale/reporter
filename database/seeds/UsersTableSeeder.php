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
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	        
        	[
	            'firstname' => 'BMW Sales',
	            'surname' => 'Executive 1',
	            'email' => 'bmwsales.executive1@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Sales Executive',
	            'dealership_id' => 1,
	            'group_id' => 1,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	            
        	[
	            'firstname' => 'MINI Sales',
	            'surname' => 'Executive 1',
	            'email' => 'minisales.executive1@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Sales Executive',
	            'dealership_id' => 6,
	            'group_id' => 1,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],	            
        	[
	            'firstname' => 'MINI Sales',
	            'surname' => 'Executive 2',
	            'email' => 'minisales.executive2@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Sales Executive',
	            'dealership_id' => 7,
	            'group_id' => 1,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
