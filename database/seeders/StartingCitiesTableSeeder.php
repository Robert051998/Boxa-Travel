<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StartingCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('starting_cities')->truncate();
        
        DB::table('starting_cities')->insert([
                ['id' => 1 , 'name' => 'New York', 'image' => 'starting_city_1.jpg'],
                ['id' => 2 , 'name' => 'Sydney', 'image' => 'starting_city_2.jpg'],
                ['id' => 3 , 'name' => 'Paris', 'image' => 'starting_city_3.jpg'],
                ['id' => 4 , 'name' => 'Barcelona', 'image' => 'starting_city_4.jpg'],
                ['id' => 5 , 'name' => 'Berlin', 'image' => 'starting_city_5.jpg'],
                ['id' => 6 , 'name' => 'Budapest', 'image' => 'starting_city_6.jpg'],
        ]);
    }
}
