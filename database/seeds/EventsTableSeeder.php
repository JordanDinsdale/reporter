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
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-22',
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
	            'name' => 'Halliwell Jones Southport BMW Q2 VIP Event 2019',
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-22',
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
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-22',
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
	            'start_date' => '2019-07-19',
	            'end_date' => '2019-07-22',
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
	        ],
        	[
	            'name' => 'MC Motors Avignon VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 52,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'L.Warsemann Auto 37 Tours VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 53,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Nouvelle Excel Auto Rennes VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 54,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Espace 3000 Besançon VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 55,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Europe Garage Services Bourg en Bresse VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 56,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Skoda Paris Est Villemonble VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 57,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'NDS City Car Saint-Ouen l\'Aumone VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 58,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Excel Motors Nancy VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 59,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Premium Picardie Amiens VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 60,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'WelcomCar Orléans VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 61,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Carlier Automobiles Douai VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 62,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Nice Car SA Nice VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 63,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Riviera Technic Cannes VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 64,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Peyo Automobiles Bayonne VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 65,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'L.G.A. La Rochelle VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 66,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Saphir Automobiles Montpellier VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 67,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Vega Automobile Brétigny sur Orge VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 68,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Espace Automobiles Nîmois Nîmes VIP Event',
	            'start_date' => '2019-01-18',
	            'end_date' => '2019-01-20',
	            'dealership_id' => 69,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Feyaerts VIP Event',
	            'start_date' => '2018-05-30',
	            'end_date' => '2018-06-02',
	            'dealership_id' => 70,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Ciac VIP Event',
	            'start_date' => '2018-06-06',
	            'end_date' => '2018-06-09',
	            'dealership_id' => 71,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Morren St Truiden VIP Event',
	            'start_date' => '2018-10-10',
	            'end_date' => '2018-10-13',
	            'dealership_id' => 72,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Morren Diest VIP Event',
	            'start_date' => '2018-10-24',
	            'end_date' => '2018-10-27',
	            'dealership_id' => 73,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'AB Automotive VIP Event',
	            'start_date' => '2018-10-10',
	            'end_date' => '2018-10-13',
	            'dealership_id' => 74,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Driessen VIP Event',
	            'start_date' => '2018-12-06',
	            'end_date' => '2018-12-09',
	            'dealership_id' => 75,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Hasselt Motor VIP Event',
	            'start_date' => '2018-12-13',
	            'end_date' => '2018-12-16',
	            'dealership_id' => 76,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Van Hoye VIP Event',
	            'start_date' => '2018-12-20',
	            'end_date' => '2018-12-23',
	            'dealership_id' => 77,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Matel Motors VIP Event',
	            'start_date' => '2018-05-23',
	            'end_date' => '2018-05-26',
	            'dealership_id' => 78,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'De Doncker VIP Event',
	            'start_date' => '2018-06-06',
	            'end_date' => '2018-06-09',
	            'dealership_id' => 79,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'SPIRLET Auto VIP Event',
	            'start_date' => '2018-06-06',
	            'end_date' => '2018-06-09',
	            'dealership_id' => 80,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Centre Motor VIP Event',
	            'start_date' => '2018-12-06',
	            'end_date' => '2018-12-08',
	            'dealership_id' => 81,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Colson VIP Event',
	            'start_date' => '2018-11-28',
	            'end_date' => '2018-12-01',
	            'dealership_id' => 82,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Vanspringel VIP Event',
	            'start_date' => '2018-12-05',
	            'end_date' => '2018-12-08',
	            'dealership_id' => 83,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Premium Trade Cars All Brand Event',
	            'start_date' => '2019-07-26',
	            'end_date' => '2019-07-28',
	            'dealership_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
        	[
	            'name' => 'Halliwell Jones Southport BMW Q3 VIP Event 2019',
	            'start_date' => '2019-10-31',
	            'end_date' => '2019-11-02',
	            'dealership_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	    ]);
    }
}
