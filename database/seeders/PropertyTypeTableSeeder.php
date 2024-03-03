<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_type')->truncate();
    	
        DB::table('property_type')->insert([
					['name' => 'Apartment','description' => 'Apartment'],
					['name' => 'House','description' => 'House'],
					['name' => 'Bungalow','description' => 'Bungalow'],
					['name' => 'Cabin','description' => 'Cabin'],
					['name' => 'Hotel','description' => 'Hotel'],
					['name' => 'Motel','description' => 'Motel'],
					['name' => 'Caravan','description' => 'Caravan'],
					['name' => 'Camping','description' => 'Camping'],
					['name' => 'Boat','description' => 'Boat'],
					['name' => 'Cottage','description' => 'Cottage'],
					['name' => 'Chalet','description' => 'Chalet'],
					['name' => 'Bed & Break Fast','description' => 'Bed & Break Fast'],  				      
					['name' => 'Other','description' => 'Other']
        	]);
    }
}
