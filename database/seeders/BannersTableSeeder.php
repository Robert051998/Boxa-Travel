<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();

        DB::table('banners')->insert([
        		['heading' => 'Welcome to Hotel', 'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'image' => 'banner_1.jpg'],
        	]);
    }
}
