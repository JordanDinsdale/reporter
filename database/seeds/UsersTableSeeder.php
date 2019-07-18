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
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'BMW',
	            'surname' => 'Group',
	            'email' => 'bmwgroup@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Company',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => NULL,
	            'manufacturer_id' => NULL,
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'BMW',
	            'surname' => 'Manufacturer',
	            'email' => 'bmwmanufacturer@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Manufacturer',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => NULL,
	            'manufacturer_id' => 4,
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'Honda',
	            'surname' => 'Manufacturer',
	            'email' => 'hondamanufacturer@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Manufacturer',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => NULL,
	            'manufacturer_id' => 10,
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'BMW',
	            'surname' => 'UK',
	            'email' => 'bmwuk@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Country',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'manufacturer_id' => 4,
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'Honda',
	            'surname' => 'UK',
	            'email' => 'hondauk@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Country',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'manufacturer_id' => 10,
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'BMW',
	            'surname' => 'North UK',
	            'email' => 'bmwnorthuk@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Region',
	            'dealership_id' => NULL,
	            'group_id' => NULL,
	            'region_id' => 1,
	            'country_id' => 5,
	            'manufacturer_id' => 4,
	            'company_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'Halliwell',
	            'surname' => 'Jones',
	            'email' => 'halliwelljones@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Group',
	            'dealership_id' => NULL,
	            'group_id' => 1,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'manufacturer_id' => NULL,
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'firstname' => 'Halliwell Jones',
	            'surname' => 'Southport MINI',
	            'email' => 'halliwelljonessouthportmini@rhinogroup.co.uk',
	            'password' => bcrypt('secret'),
	            'level' => 'Dealership',
	            'dealership_id' => 6,
	            'group_id' => 1,
	            'region_id' => NULL,
	            'country_id' => 5,
	            'manufacturer_id' => NULL,
	            'company_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
