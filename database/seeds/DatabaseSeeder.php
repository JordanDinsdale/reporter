<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompaniesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(DealershipsTableSeeder::class);
        $this->call(DealershipManufacturerTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventManufacturerTableSeeder::class);
    }
}
