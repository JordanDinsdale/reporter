<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_manufacturer')->insert([

        	// Premium Trade Cars BMW MINI Event

        	[
	            'event_id' => 1,
	            'manufacturer_id' => 4,
	            'data_count' => 4000,
	            'appointments' => 500,
	            'new' => 50,
	            'used' => 30,
	            'zero_km' => 10,
	            'demo' => 5,
	            'inprogress' => 3
	        ],
        	[
	            'event_id' => 1,
	            'manufacturer_id' => 20,
	            'data_count' => 3000,
	            'appointments' => 400,
	            'new' => 30,
	            'used' => 20,
	            'zero_km' => 5,
	            'demo' => 3,
	            'inprogress' => 2
	        ],

        	// Bowker Ribble Valley FCA Group Event

        	[
	            'event_id' => 2,
	            'manufacturer_id' => 1,
	            'data_count' => 3600,
	            'appointments' => 600,
	            'new' => 30,
	            'used' => 10,
	            'zero_km' => 9,
	            'demo' => 6,
	            'inprogress' => 3
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 2,
	            'data_count' => 2400,
	            'appointments' => 400,
	            'new' => 20,
	            'used' => 15,
	            'zero_km' => 12,
	            'demo' => 9,
	            'inprogress' => 2
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 8,
	            'data_count' => 4200,
	            'appointments' => 500,
	            'new' => 40,
	            'used' => 35,
	            'zero_km' => 32,
	            'demo' => 19,
	            'inprogress' => 12
	        ],
        	[
	            'event_id' => 2,
	            'manufacturer_id' => 14,
	            'data_count' => 2200,
	            'appointments' => 300,
	            'new' => 32,
	            'used' => 18,
	            'zero_km' => 10,
	            'demo' => 15,
	            'inprogress' => 4
	        ],

	        // Bowker Blackburn BMW VIP Event 2018

        	[
	            'event_id' => 3,
	            'manufacturer_id' => 4,
	            'data_count' => 1800,
	            'appointments' => 120,
	            'new' => 22,
	            'used' => 32,
	            'zero_km' => 8,
	            'demo' => 4,
	            'inprogress' => 4
	        ],

	        // Bowker Blackburn BMW VIP Event 2019

        	[
	            'event_id' => 4,
	            'manufacturer_id' => 4,
	            'data_count' => 2200,
	            'appointments' => 140,
	            'new' => 32,
	            'used' => 41,
	            'zero_km' => 15,
	            'demo' => 5,
	            'inprogress' => 2
	        ],

	        // Independent UK Dealership FCA Event

        	[
	            'event_id' => 5,
	            'manufacturer_id' => 1,
	            'data_count' => 2700,
	            'appointments' => 130,
	            'new' => 21,
	            'used' => 34,
	            'zero_km' => 8,
	            'demo' => 2,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 5,
	            'manufacturer_id' => 2,
	            'data_count' => 2200,
	            'appointments' => 115,
	            'new' => 12,
	            'used' => 22,
	            'zero_km' => 6,
	            'demo' => 2,
	            'inprogress' => 1
	        ],
	        [
	            'event_id' => 5,
	            'manufacturer_id' => 8,
	            'data_count' => 1670,
	            'appointments' => 83,
	            'new' => 8,
	            'used' => 6,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 5,
	            'manufacturer_id' => 14,
	            'data_count' => 3670,
	            'appointments' => 103,
	            'new' => 18,
	            'used' => 16,
	            'zero_km' => 10,
	            'demo' => 3,
	            'inprogress' => 1
	        ],

	        // Halliwell Jones Southport BMW VIP Event 2018

        	[
	            'event_id' => 6,
	            'manufacturer_id' => 4,
	            'data_count' => 1270,
	            'appointments' => 106,
	            'new' => 17,
	            'used' => 23,
	            'zero_km' => 5,
	            'demo' => 2,
	            'inprogress' => 2
	        ],

	        // Halliwell Jones Southport BMW VIP Event 2019

        	[
	            'event_id' => 7,
	            'manufacturer_id' => 4,
	            'data_count' => 2780,
	            'appointments' => 143,
	            'new' => 12,
	            'used' => 31,
	            'zero_km' => 4,
	            'demo' => 3,
	            'inprogress' => 2
	        ],

	        // Halliwell Jones Wilslow BMW VIP Event 2018

        	[
	            'event_id' => 8,
	            'manufacturer_id' => 4,
	            'data_count' => 1784,
	            'appointments' => 186,
	            'new' => 23,
	            'used' => 19,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // Halliwell Jones Wilmslow BMW VIP Event 2019

        	[
	            'event_id' => 9,
	            'manufacturer_id' => 4,
	            'data_count' => 2180,
	            'appointments' => 93,
	            'new' => 8,
	            'used' => 11,
	            'zero_km' => 0,
	            'demo' => 3,
	            'inprogress' => 1
	        ],

	        // Bowker Preston BMW VIP Event 2018

        	[
	            'event_id' => 10,
	            'manufacturer_id' => 4,
	            'data_count' => 1894,
	            'appointments' => 126,
	            'new' => 29,
	            'used' => 22,
	            'zero_km' => 2,
	            'demo' => 1,
	            'inprogress' => 0
	        ],

	        // Bowker Preston BMW VIP Event 2019

        	[
	            'event_id' => 11,
	            'manufacturer_id' => 4,
	            'data_count' => 2220,
	            'appointments' => 204,
	            'new' => 24,
	            'used' => 12,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // LSH Mercedes-Benz Birmingham Central Golden Ticket Event

        	[
	            'event_id' => 12,
	            'manufacturer_id' => 19,
	            'data_count' => 2827,
	            'appointments' => 254,
	            'new' => 14,
	            'used' => 18,
	            'zero_km' => 1,
	            'demo' => 1,
	            'inprogress' => 0
	        ],

	        // LSH Mercedes-Benz Erdington Golden Ticket Event

        	[
	            'event_id' => 13,
	            'manufacturer_id' => 19,
	            'data_count' => 2827,
	            'appointments' => 254,
	            'new' => 14,
	            'used' => 18,
	            'zero_km' => 1,
	            'demo' => 1,
	            'inprogress' => 0
	        ],

	        // LSH Mercedes-Benz Solihull Golden Ticket Event

        	[
	            'event_id' => 14,
	            'manufacturer_id' => 19,
	            'data_count' => 3129,
	            'appointments' => 384,
	            'new' => 35,
	            'used' => 22,
	            'zero_km' => 2,
	            'demo' => 1,
	            'inprogress' => 2
	        ],

	        // LSH Mercedes-Benz Tamworth Golden Ticket Event

        	[
	            'event_id' => 15,
	            'manufacturer_id' => 19,
	            'data_count' => 2839,
	            'appointments' => 219,
	            'new' => 42,
	            'used' => 18,
	            'zero_km' => 2,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // LSH Mercedes-Benz Macclesfield Golden Ticket Event

        	[
	            'event_id' => 16,
	            'manufacturer_id' => 19,
	            'data_count' => 3268,
	            'appointments' => 402,
	            'new' => 58,
	            'used' => 32,
	            'zero_km' => 6,
	            'demo' => 1,
	            'inprogress' => 3
	        ],

	        // LSH Mercedes-Benz Manchester Central Golden Ticket Event

        	[
	            'event_id' => 17,
	            'manufacturer_id' => 19,
	            'data_count' => 4128,
	            'appointments' => 327,
	            'new' => 39,
	            'used' => 28,
	            'zero_km' => 8,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // LSH Mercedes-Benz Manchester Used Golden Ticket Event

        	[
	            'event_id' => 18,
	            'manufacturer_id' => 19,
	            'data_count' => 2228,
	            'appointments' => 143,
	            'new' => 8,
	            'used' => 54,
	            'zero_km' => 5,
	            'demo' => 3,
	            'inprogress' => 2
	        ],

	        // LSH Mercedes-Benz Stockport Golden Ticket Event

        	[
	            'event_id' => 19,
	            'manufacturer_id' => 19,
	            'data_count' => 2228,
	            'appointments' => 143,
	            'new' => 8,
	            'used' => 54,
	            'zero_km' => 5,
	            'demo' => 3,
	            'inprogress' => 2
	        ],

	        // LSH Mercedes-Benz Whitefield Golden Ticket Event

        	[
	            'event_id' => 20,
	            'manufacturer_id' => 19,
	            'data_count' => 1794,
	            'appointments' => 294,
	            'new' => 38,
	            'used' => 44,
	            'zero_km' => 4,
	            'demo' => 4,
	            'inprogress' => 1
	        ],

	        // Opel Gex Showroom VIP Event

        	[
	            'event_id' => 21,
	            'manufacturer_id' => 22,
	            'data_count' => 2642,
	            'appointments' => 42,
	            'new' => 16,
	            'used' => 4,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 1
	        ],

	        // Opel Le Cannet Platinum Event

        	[
	            'event_id' => 22,
	            'manufacturer_id' => 22,
	            'data_count' => 2985,
	            'appointments' => 17,
	            'new' => 8,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // Opel Salon de Provence Premium Event

        	[
	            'event_id' => 23,
	            'manufacturer_id' => 22,
	            'data_count' => 3810,
	            'appointments' => 48,
	            'new' => 12,
	            'used' => 3,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // Opel Rochefort Platinum Event

        	[
	            'event_id' => 24,
	            'manufacturer_id' => 22,
	            'data_count' => 1542,
	            'appointments' => 22,
	            'new' => 11,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 1
	        ],

	        // Opel Lille Showroom VIP Event

        	[
	            'event_id' => 25,
	            'manufacturer_id' => 22,
	            'data_count' => 2500,
	            'appointments' => 38,
	            'new' => 29,
	            'used' => 5,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 1
	        ],

	        // Opel Dunkerque Showroom VIP Event

        	[
	            'event_id' => 26,
	            'manufacturer_id' => 22,
	            'data_count' => 691,
	            'appointments' => 20,
	            'new' => 12,
	            'used' => 1,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Saint-Quentin Showroom VIP Event

        	[
	            'event_id' => 27,
	            'manufacturer_id' => 22,
	            'data_count' => 2548,
	            'appointments' => 27,
	            'new' => 15,
	            'used' => 8,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Fontaine-Les-Vervins Showroom VIP Event

        	[
	            'event_id' => 28,
	            'manufacturer_id' => 22,
	            'data_count' => 922,
	            'appointments' => 10,
	            'new' => 12,
	            'used' => 1,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Tourcoing Showroom VIP Event

        	[
	            'event_id' => 29,
	            'manufacturer_id' => 22,
	            'data_count' => 1860,
	            'appointments' => 29,
	            'new' => 25,
	            'used' => 3,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // Opel Valenciennes Showroom VIP Event

        	[
	            'event_id' => 30,
	            'manufacturer_id' => 22,
	            'data_count' => 2257,
	            'appointments' => 37,
	            'new' => 22,
	            'used' => 1,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 2
	        ],

	        // Opel Villeneuve d'Ascq Showroom VIP Event

        	[
	            'event_id' => 31,
	            'manufacturer_id' => 22,
	            'data_count' => 2199,
	            'appointments' => 29,
	            'new' => 24,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Laon Showroom VIP Event

        	[
	            'event_id' => 32,
	            'manufacturer_id' => 22,
	            'data_count' => 2323,
	            'appointments' => 8,
	            'new' => 8,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Frejus Showroom VIP Event

        	[
	            'event_id' => 33,
	            'manufacturer_id' => 22,
	            'data_count' => 2256,
	            'appointments' => 26,
	            'new' => 16,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Soisson Showroom VIP Event

        	[
	            'event_id' => 34,
	            'manufacturer_id' => 22,
	            'data_count' => 839,
	            'appointments' => 10,
	            'new' => 3,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Opel Orléans Showroom VIP Event

        	[
	            'event_id' => 35,
	            'manufacturer_id' => 22,
	            'data_count' => 1495,
	            'appointments' => 12,
	            'new' => 16,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 1
	        ],

	        // Opel Tours Showroom VIP Event

        	[
	            'event_id' => 36,
	            'manufacturer_id' => 22,
	            'data_count' => 2000,
	            'appointments' => 42,
	            'new' => 25,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 1
	        ]

	    ]);
    }
}
