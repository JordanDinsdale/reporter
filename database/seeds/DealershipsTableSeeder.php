<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DealershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dealerships')->insert([

        	// Halliwell Jones

        	[
	            'name' => 'Halliwell Jones Southport BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Chester BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Warrington BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones North Wales BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Wilmslow BMW',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Southport MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Chester MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Warrington MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones North Wales MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Halliwell Jones Wilmslow MINI',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Premium Trade Cars',
	            'group_id' => 1,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Motor Group

	        [
	            'name' => 'Bowker Preston BMW',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Preston MINI',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Blackburn BMW',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Blackburn MINI',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Bowker Ribble Valley',
	            'group_id' => 2,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH

	        [
	            'name' => 'LSH Mercedes-Benz Birmingham Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Erdington',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Macclesfield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Manchester Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Manchester Used',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Solihull',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Stockport',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Tamworth',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Mercedes-Benz Whitefield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Birmingham Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Macclesfield',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Manchester Central',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'LSH Smart Tamworth',
	            'group_id' => 3,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Indpendent UK Dealership

	        [
	            'name' => 'Independent UK Dealership',
	            'group_id' => NULL,
	            'country_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Independent Opel Dealerships§

	        [
	            'name' => 'Opel Gex',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Le Cannet',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Salon de Provence',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Rochefort',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Lille',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Dunkerque',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Saint-Quentin',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Fontaine-Les-Vervins',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Tourcoing',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Valenciennes',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Villeneuve d\'Ascq',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Laon',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Chartres',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Evreux',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Frejus',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Muret',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Soissons',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Vernon',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Orléans',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Tours',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Opel Rouen',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Skoda France

	        [
	            'name' => 'MC Motors Avignon',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'L.Warsemann Auto 37 Tours',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Nouvelle Excel Auto Rennes',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Espace 3000 Besançon',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Europe Garage Services Bourg en Bresse',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Skoda Paris Est Villemonble',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'NDS City Car Saint-Ouen l\'Aumone',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Excel Motors Nancy',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Premium Picardie Amiens',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'WelcomCar Orléans',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Carlier Automobiles Douai',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Nice Car SA Nice',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Riviera Technic Cannes',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Peyo Automobiles Bayonne',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'L.G.A. La Rochelle',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Saphir Automobiles Montpellier',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Vega Automobile Brétigny sur Orge',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Espace Automobiles Nîmois Nîmes',
	            'group_id' => NULL,
	            'country_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        //Ford Belgium 

	        [
	            'name' => 'Feyaerts',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Ciac',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Morren St Truiden',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Morren Diest',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'AB Automotive',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Driessen',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Hasselt Motor',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Van Hoye',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Matel Motors',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'De Doncker',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'SPIRLET Auto',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Centre Motor',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Colson',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => 'Vanspringel',
	            'group_id' => NULL,
	            'country_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]

	    ]);
    }
}
