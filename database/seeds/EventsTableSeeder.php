<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
        	[
	            'name' => 'Premium Trade Cars BMW MINI Event',
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-21',
	            'dealership_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Bowker Ribble Valley FCA Group Event',
	            'start_date' => '2019-07-26',
	            'end_date' => '2019-07-28',
	            'dealership_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Bowker Blackburn BMW VIP Event 2018',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-29',
	            'dealership_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Bowker Blackburn BMW VIP Event 2019',
	            'start_date' => '2018-07-19',
	            'end_date' => '2018-07-22',
	            'dealership_id' => 14,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Independent UK Dealership FCA Event',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-28',
	            'dealership_id' => 30,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Halliwell Jones Southport BMW VIP Event 2018',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-29',
	            'dealership_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Halliwell Jones Southport BMW VIP Event 2019',
	            'start_date' => '2018-07-19',
	            'end_date' => '2018-07-22',
	            'dealership_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Halliwell Jones Wilmslow BMW VIP Event 2018',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-29',
	            'dealership_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Halliwell Jones Wilmslow BMW VIP Event 2019',
	            'start_date' => '2018-07-19',
	            'end_date' => '2018-07-22',
	            'dealership_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Bowker Preston BMW VIP Event 2018',
	            'start_date' => '2018-07-26',
	            'end_date' => '2018-07-29',
	            'dealership_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Bowker Preston BMW VIP Event 2019',
	            'start_date' => '2018-07-19',
	            'end_date' => '2018-07-22',
	            'dealership_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Birmingham Central Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Erdington Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Solihull Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 22,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Tamworth Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 24,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Macclesfield Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 19,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Manchester Central Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 20,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Manchester Used Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 21,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Stockport Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 23,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'LSH Mercedes-Benz Whitefield Golden Ticket Event',
	            'start_date' => '2019-06-01',
	            'end_date' => '2019-06-02',
	            'dealership_id' => 25,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Gex Showroom VIP Event',
	            'start_date' => '2019-04-10',
	            'end_date' => '2019-04-13',
	            'dealership_id' => 31,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Le Cannet Platinum Event',
	            'start_date' => '2019-04-24',
	            'end_date' => '2019-04-27',
	            'dealership_id' => 32,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Salon de Provence Premium Event',
	            'start_date' => '2019-05-15',
	            'end_date' => '2019-05-18',
	            'dealership_id' => 33,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Rochefort Platinum Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 34,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Lille Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 35,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Dunkerque Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 36,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Saint-Quentin Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 37,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Fontaine-Les-Vervins Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 38,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Tourcoing Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 39,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Valenciennes Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 40,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Villeneuve d\'Ascq Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 41,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Laon Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 42,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Frejus Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 45,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Soissons Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 47,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Orléans Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 49,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Opel Tours Showroom VIP Event',
	            'start_date' => '2019-05-23',
	            'end_date' => '2019-05-25',
	            'dealership_id' => 50,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]
	    ]);
    }
}
