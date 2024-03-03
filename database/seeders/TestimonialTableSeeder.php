<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->truncate();

        DB::table('testimonials')->insert([
        		['name' => 'John Doe', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'designation'=>'Traveller', 'status'=>'Active', 'review'=>5, 'image' => 'testimonial_1.jpg'],
        		['name' => 'Adam Smith', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'designation'=>'Traveller', 'status'=>'Active', 'review'=>5, 'image' => 'testimonial_2.jpg'],
        		['name' => 'Alysa', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'designation'=>'Photographer', 'status'=>'Active', 'review'=>5, 'image' => 'testimonial_3.jpg'],
        	]);
    }
}
