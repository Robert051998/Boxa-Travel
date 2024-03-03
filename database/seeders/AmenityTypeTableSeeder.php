<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amenity_type')->truncate();
    	
        DB::table('amenity_type')->insert([
        		['name' => 'Common Amenities','description' => ''],
  				['name' => 'Safety Amenities','description' => ''],
  				['name' => 'ECO-friendly Amenities','description' => 'eco-friendly'],
        	]);
    }
}
