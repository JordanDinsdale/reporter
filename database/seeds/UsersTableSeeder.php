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
        DB::table('users')->insert(
        	[
	            'firstname' => 'Jordan',
	            'surname' => 'Dinsdale',
	            'email' => 'jordan.dinsdale@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Admin',
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    );
    }
}
