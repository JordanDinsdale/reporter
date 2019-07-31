<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DealershipManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dealership_manufacturer')->insert([

        	// Halliwell Jones Southport BMW

        	[
	            'dealership_id' => 1,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Chester BMW
        	
        	[
	            'dealership_id' => 2,
	            'manufacturer_id' => 4,
	            'region_id' => 2,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Warrington BMW

	        [
	            'dealership_id' => 3,
	            'manufacturer_id' => 4,
	            'region_id' => 3,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones North Wales BMW

	        [
	            'dealership_id' => 4,
	            'manufacturer_id' => 4,
	            'region_id' => 4,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Wilmslow BMW

	        [
	            'dealership_id' => 5,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Southport MINI

	        [
	            'dealership_id' => 6,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Chester MINI

	        [
	            'dealership_id' => 7,
	            'manufacturer_id' => 20,
	            'region_id' => 6,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Warrington MINI

	        [
	            'dealership_id' => 8,
	            'manufacturer_id' => 20,
	            'region_id' => 7,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones North Wales MINI

	        [
	            'dealership_id' => 9,
	            'manufacturer_id' => 20,
	            'region_id' => 8,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Halliwell Jones Wilmslow MINI

	        [
	            'dealership_id' => 10,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Premium Trade Cars

	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 2,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 3,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 4,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 5,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 6,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 7,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 8,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 10,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 12,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 13,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 14,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 16,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 17,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 18,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 20,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 21,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 23,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 24,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 25,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 26,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 11,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Preston BMW

	        [
	            'dealership_id' => 12,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Preston MINI

	        [
	            'dealership_id' => 13,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Blackburn BMW

	        [
	            'dealership_id' => 14,
	            'manufacturer_id' => 4,
	            'region_id' => 1,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Blackburn MINI

	        [
	            'dealership_id' => 15,
	            'manufacturer_id' => 20,
	            'region_id' => 5,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Bowker Ribble Valley

	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 1,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 2,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 4,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 7,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 8,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 12,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 14,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 16,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 18,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 26,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 16,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Birmingham Central

	        [
	            'dealership_id' => 17,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Erdington

	        [
	            'dealership_id' => 18,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Macclesfield

	        [
	            'dealership_id' => 19,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Manchester Central

	        [
	            'dealership_id' => 20,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Manchester Used

	        [
	            'dealership_id' => 21,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Solihull

	        [
	            'dealership_id' => 22,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Stockport

	        [
	            'dealership_id' => 23,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Tamworth

	        [
	            'dealership_id' => 24,
	            'manufacturer_id' => 19,
	            'region_id' => 11,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Mercedes-Benz Whitefield

	        [
	            'dealership_id' => 25,
	            'manufacturer_id' => 19,
	            'region_id' => 10,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Birmingham Central

	        [
	            'dealership_id' => 26,
	            'manufacturer_id' => 28,
	            'region_id' => 13,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Macclesfield

	        [
	            'dealership_id' => 27,
	            'manufacturer_id' => 28,
	            'region_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Manchester Central

	        [
	            'dealership_id' => 28,
	            'manufacturer_id' => 28,
	            'region_id' => 12,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // LSH Smart Tamworth

	        [
	            'dealership_id' => 29,
	            'manufacturer_id' => 28,
	            'region_id' => 13,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Independent UK Dealership

	        [
	            'dealership_id' => 30,
	            'manufacturer_id' => 1,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 30,
	            'manufacturer_id' => 2,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 30,
	            'manufacturer_id' => 8,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'dealership_id' => 30,
	            'manufacturer_id' => 14,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Gex

	        [
	            'dealership_id' => 31,
	            'manufacturer_id' => 22,
	            'region_id' => 23,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Le Cannet

	        [
	            'dealership_id' => 32,
	            'manufacturer_id' => 22,
	            'region_id' => 24,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Salon de Provence

	        [
	            'dealership_id' => 33,
	            'manufacturer_id' => 22,
	            'region_id' => 24,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Rochefort

	        [
	            'dealership_id' => 34,
	            'manufacturer_id' => 22,
	            'region_id' => 27,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Lille

	        [
	            'dealership_id' => 35,
	            'manufacturer_id' => 22,
	            'region_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Dunkerque

	        [
	            'dealership_id' => 36,
	            'manufacturer_id' => 22,
	            'region_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Saint-Quentin

	        [
	            'dealership_id' => 37,
	            'manufacturer_id' => 22,
	            'region_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Fontaine-Les-Vervins

	        [
	            'dealership_id' => 38,
	            'manufacturer_id' => 22,
	            'region_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Tourcoing

	        [
	            'dealership_id' => 39,
	            'manufacturer_id' => 22,
	            'region_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Valenciennes

	        [
	            'dealership_id' => 40,
	            'manufacturer_id' => 22,
	            'region_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Villeneuve d'Ascq

	        [
	            'dealership_id' => 41,
	            'manufacturer_id' => 22,
	            'region_id' => 17,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Laon

	        [
	            'dealership_id' => 42,
	            'manufacturer_id' => 22,
	            'region_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Chartres

	        [
	            'dealership_id' => 43,
	            'manufacturer_id' => 22,
	            'region_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Evreux

	        [
	            'dealership_id' => 44,
	            'manufacturer_id' => 22,
	            'region_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Frejus

	        [
	            'dealership_id' => 45,
	            'manufacturer_id' => 22,
	            'region_id' => 24,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Muret

	        [
	            'dealership_id' => 46,
	            'manufacturer_id' => 22,
	            'region_id' => 26,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Soissons

	        [
	            'dealership_id' => 47,
	            'manufacturer_id' => 22,
	            'region_id' => 16,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Vernon

	        [
	            'dealership_id' => 48,
	            'manufacturer_id' => 22,
	            'region_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Orléans

	        [
	            'dealership_id' => 49,
	            'manufacturer_id' => 22,
	            'region_id' => 27,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Tours

	        [
	            'dealership_id' => 50,
	            'manufacturer_id' => 22,
	            'region_id' => 27,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Opel Rouen

	        [
	            'dealership_id' => 51,
	            'manufacturer_id' => 22,
	            'region_id' => 18,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // MC Motors

	        [
	            'dealership_id' => 52,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // L.Warsemann Auto 37

	        [
	            'dealership_id' => 53,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Nouvelle Excel Auto

	        [
	            'dealership_id' => 54,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Espace 3000

	        [
	            'dealership_id' => 55,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Europe Garage Services

	        [
	            'dealership_id' => 56,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Skoda Paris Est

	        [
	            'dealership_id' => 57,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // NDS City Car

	        [
	            'dealership_id' => 58,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Excel Motors

	        [
	            'dealership_id' => 59,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Premium Picardie

	        [
	            'dealership_id' => 60,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // WelcomCar

	        [
	            'dealership_id' => 61,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Carlier Automobiles

	        [
	            'dealership_id' => 62,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Nice Car SA

	        [
	            'dealership_id' => 63,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Riviera Technic

	        [
	            'dealership_id' => 64,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Peyo Automobiles

	        [
	            'dealership_id' => 65,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // L.G.A.

	        [
	            'dealership_id' => 66,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Saphir Automobiles

	        [
	            'dealership_id' => 67,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Vega Automobile

	        [
	            'dealership_id' => 68,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Espace Automobiles Nîmois

	        [
	            'dealership_id' => 69,
	            'manufacturer_id' => 27,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Fayaerts

	        [
	            'dealership_id' => 70,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Ciac

	        [
	            'dealership_id' => 71,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Morren St Truiden

	        [
	            'dealership_id' => 72,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Morren Diest

	        [
	            'dealership_id' => 73,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // AB Automotive

	        [
	            'dealership_id' => 74,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Driessen

	        [
	            'dealership_id' => 75,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Hasselt Motor

	        [
	            'dealership_id' => 76,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Van Hoye

	        [
	            'dealership_id' => 77,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Matel Motors

	        [
	            'dealership_id' => 78,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // De Doncker

	        [
	            'dealership_id' => 79,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // SPIRLET Auto

	        [
	            'dealership_id' => 80,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Centre Motor

	        [
	            'dealership_id' => 81,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Colson

	        [
	            'dealership_id' => 82,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],

	        // Vanspringel

	        [
	            'dealership_id' => 83,
	            'manufacturer_id' => 9,
	            'region_id' => NULL,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]

	    ]);
    }
}
