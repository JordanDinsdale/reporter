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

	        // Halliwell Jones Wilmslow BMW Q2 VIP Event 2019

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
	            'inprogress' => 11
	        ],

	        // MC Motors Avignon VIP Event

        	[
	            'event_id' => 37,
	            'manufacturer_id' => 27,
	            'data_count' => 1239,
	            'appointments' => 33,
	            'new' => 17,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // L.Warsemann Auto 37 Tours VIP Event

        	[
	            'event_id' => 38,
	            'manufacturer_id' => 27,
	            'data_count' => 726,
	            'appointments' => 35,
	            'new' => 19,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 2,
	            'inprogress' => 0
	        ],

	        // Nouvelle Excel Auto Rennes VIP Event

        	[
	            'event_id' => 39,
	            'manufacturer_id' => 27,
	            'data_count' => 1974,
	            'appointments' => 41,
	            'new' => 8,
	            'used' => 8,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Espace 3000 Besançon VIP Event

        	[
	            'event_id' => 40,
	            'manufacturer_id' => 27,
	            'data_count' => 1984,
	            'appointments' => 36,
	            'new' => 6,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 1,
	            'inprogress' => 0
	        ],

	        // Europe Garage Services Bourg en Bresse VIP Event

        	[
	            'event_id' => 41,
	            'manufacturer_id' => 27,
	            'data_count' => 1210,
	            'appointments' => 29,
	            'new' => 8,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 8,
	            'inprogress' => 0
	        ],

	        // Skoda Paris Est Villemonble VIP Event

        	[
	            'event_id' => 42,
	            'manufacturer_id' => 27,
	            'data_count' => 5166,
	            'appointments' => 28,
	            'new' => 9,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // NDS City Car Saint-Ouen l'Aumone VIP Event

        	[
	            'event_id' => 43,
	            'manufacturer_id' => 27,
	            'data_count' => 1283,
	            'appointments' => 26,
	            'new' => 14,
	            'used' => 4,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Excel Motors Nancy VIP Event

        	[
	            'event_id' => 44,
	            'manufacturer_id' => 27,
	            'data_count' => 1093,
	            'appointments' => 28,
	            'new' => 15,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Premium Picardie Amiens VIP Event

        	[
	            'event_id' => 45,
	            'manufacturer_id' => 27,
	            'data_count' => 1671,
	            'appointments' => 21,
	            'new' => 19,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // WelcomCar Orléans VIP Event

        	[
	            'event_id' => 46,
	            'manufacturer_id' => 27,
	            'data_count' => 798,
	            'appointments' => 22,
	            'new' => 16,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Carlier Automobiles Douai VIP Event

        	[
	            'event_id' => 47,
	            'manufacturer_id' => 27,
	            'data_count' => 511,
	            'appointments' => 15,
	            'new' => 9,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Nice Car SA Nice VIP Event

        	[
	            'event_id' => 48,
	            'manufacturer_id' => 27,
	            'data_count' => 2379,
	            'appointments' => 16,
	            'new' => 12,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Riviera Technic Cannes VIP Event

        	[
	            'event_id' => 49,
	            'manufacturer_id' => 27,
	            'data_count' => 1998,
	            'appointments' => 18,
	            'new' => 23,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Peyo Automobiles Bayonne VIP Event

        	[
	            'event_id' => 50,
	            'manufacturer_id' => 27,
	            'data_count' => 1282,
	            'appointments' => 19,
	            'new' => 17,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // L.G.A. La Rochelle VIP Event

        	[
	            'event_id' => 51,
	            'manufacturer_id' => 27,
	            'data_count' => 1259,
	            'appointments' => 30,
	            'new' => 12,
	            'used' => 5,
	            'zero_km' => 0,
	            'demo' => 1,
	            'inprogress' => 0
	        ],

	        // Saphir Automobiles Montpellier VIP Event

        	[
	            'event_id' => 52,
	            'manufacturer_id' => 27,
	            'data_count' => 2777,
	            'appointments' => 17,
	            'new' => 8,
	            'used' => 3,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Vega Automobile Brétigny sur Orge VIP Event

        	[
	            'event_id' => 53,
	            'manufacturer_id' => 27,
	            'data_count' => 1493,
	            'appointments' => 56,
	            'new' => 7,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 16,
	            'inprogress' => 0
	        ],

	        // Espace Automobiles Nîmois Nîmes VIP Event

        	[
	            'event_id' => 54,
	            'manufacturer_id' => 27,
	            'data_count' => 1388,
	            'appointments' => 25,
	            'new' => 21,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Feyaerts VIP Event

        	[
	            'event_id' => 55,
	            'manufacturer_id' => 9,
	            'data_count' => 4435,
	            'appointments' => 70,
	            'new' => 20,
	            'used' => 15,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Ciac VIP Event

        	[
	            'event_id' => 56,
	            'manufacturer_id' => 9,
	            'data_count' => 2709,
	            'appointments' => 55,
	            'new' => 10,
	            'used' => 12,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Morren St Truiden VIP Event

        	[
	            'event_id' => 57,
	            'manufacturer_id' => 9,
	            'data_count' => 5781,
	            'appointments' => 130,
	            'new' => 50,
	            'used' => 42,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Morren Diest VIP Event

        	[
	            'event_id' => 58,
	            'manufacturer_id' => 9,
	            'data_count' => 5402,
	            'appointments' => 95,
	            'new' => 20,
	            'used' => 40,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // AB Automotive VIP Event

        	[
	            'event_id' => 59,
	            'manufacturer_id' => 9,
	            'data_count' => 4401,
	            'appointments' => 80,
	            'new' => 20,
	            'used' => 20,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Driessen VIP Event

        	[
	            'event_id' => 60,
	            'manufacturer_id' => 9,
	            'data_count' => 4999,
	            'appointments' => 115,
	            'new' => 35,
	            'used' => 20,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Hasselt Motor VIP Event

        	[
	            'event_id' => 61,
	            'manufacturer_id' => 9,
	            'data_count' => 5324,
	            'appointments' => 80,
	            'new' => 20,
	            'used' => 20,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Van Hoye VIP Event

        	[
	            'event_id' => 62,
	            'manufacturer_id' => 9,
	            'data_count' => 807,
	            'appointments' => 32,
	            'new' => 9,
	            'used' => 7,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Matel Motors VIP Event

        	[
	            'event_id' => 63,
	            'manufacturer_id' => 9,
	            'data_count' => 4555,
	            'appointments' => 70,
	            'new' => 20,
	            'used' => 15,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // De Doncker VIP Event

        	[
	            'event_id' => 64,
	            'manufacturer_id' => 9,
	            'data_count' => 4999,
	            'appointments' => 61,
	            'new' => 30,
	            'used' => 23,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // SPIRLET Auto VIP Event

        	[
	            'event_id' => 65,
	            'manufacturer_id' => 9,
	            'data_count' => 4901,
	            'appointments' => 30,
	            'new' => 11,
	            'used' => 11,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Centre Motor VIP Event

        	[
	            'event_id' => 66,
	            'manufacturer_id' => 9,
	            'data_count' => 5028,
	            'appointments' => 60,
	            'new' => 20,
	            'used' => 13,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Colson VIP Event

        	[
	            'event_id' => 67,
	            'manufacturer_id' => 9,
	            'data_count' => 3605,
	            'appointments' => 40,
	            'new' => 13,
	            'used' => 13,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Vanspringel VIP Event

        	[
	            'event_id' => 68,
	            'manufacturer_id' => 9,
	            'data_count' => 5147,
	            'appointments' => 42,
	            'new' => 14,
	            'used' => 14,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Premium Trade Cars All Brand Event

        	[
	            'event_id' => 69,
	            'manufacturer_id' => 2,
	            'data_count' => 2137,
	            'appointments' => 21,
	            'new' => 7,
	            'used' => 7,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 3,
	            'data_count' => 1943,
	            'appointments' => 19,
	            'new' => 5,
	            'used' => 7,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 4,
	            'data_count' => 2567,
	            'appointments' => 28,
	            'new' => 8,
	            'used' => 6,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 5,
	            'data_count' => 2348,
	            'appointments' => 16,
	            'new' => 4,
	            'used' => 6,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 6,
	            'data_count' => 1746,
	            'appointments' => 32,
	            'new' => 9,
	            'used' => 5,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 7,
	            'data_count' => 1546,
	            'appointments' => 16,
	            'new' => 4,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 8,
	            'data_count' => 1324,
	            'appointments' => 12,
	            'new' => 1,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 10,
	            'data_count' => 1428,
	            'appointments' => 20,
	            'new' => 5,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 12,
	            'data_count' => 1875,
	            'appointments' => 19,
	            'new' => 4,
	            'used' => 5,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 13,
	            'data_count' => 1234,
	            'appointments' => 12,
	            'new' => 1,
	            'used' => 3,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 14,
	            'data_count' => 1684,
	            'appointments' => 31,
	            'new' => 15,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 16,
	            'data_count' => 1721,
	            'appointments' => 23,
	            'new' => 3,
	            'used' => 8,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 17,
	            'data_count' => 1834,
	            'appointments' => 30,
	            'new' => 12,
	            'used' => 8,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 18,
	            'data_count' => 1324,
	            'appointments' => 12,
	            'new' => 0,
	            'used' => 8,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 19,
	            'data_count' => 1543,
	            'appointments' => 19,
	            'new' => 4,
	            'used' => 6,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 20,
	            'data_count' => 1629,
	            'appointments' => 24,
	            'new' => 5,
	            'used' => 4,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 21,
	            'data_count' => 2186,
	            'appointments' => 32,
	            'new' => 9,
	            'used' => 3,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 23,
	            'data_count' => 2423,
	            'appointments' => 29,
	            'new' => 12,
	            'used' => 4,
	            'zero_km' => 0,
	            'demo' => 2,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 24,
	            'data_count' => 2792,
	            'appointments' => 28,
	            'new' => 5,
	            'used' => 2,
	            'zero_km' => 0,
	            'demo' => 2,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 25,
	            'data_count' => 2192,
	            'appointments' => 42,
	            'new' => 15,
	            'used' => 7,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 26,
	            'data_count' => 1623,
	            'appointments' => 42,
	            'new' => 15,
	            'used' => 7,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],
	        [
	            'event_id' => 69,
	            'manufacturer_id' => 27,
	            'data_count' => 1829,
	            'appointments' => 38,
	            'new' => 14,
	            'used' => 4,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	        // Halliwell Jones Wilmslow BMW Q3 VIP Event 2019

        	[
	            'event_id' => 70,
	            'manufacturer_id' => 4,
	            'data_count' => 0,
	            'appointments' => 0,
	            'new' => 0,
	            'used' => 0,
	            'zero_km' => 0,
	            'demo' => 0,
	            'inprogress' => 0
	        ],

	    ]);
    }
}
