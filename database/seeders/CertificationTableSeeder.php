<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certification')->truncate();
    	
        DB::table('certification')->insert([
					['name' => ' Slovenia Green','description' => ' Slovenia Green'],
					['name' => 'Bio Hotels','description' => 'Bio Hotels'],
					['name' => 'Ecocamping','description' => 'Ecocamping'],
					['name' => 'EMAS','description' => 'EMAS'],
					['name' => 'EU Ecolabel','description' => 'EU Ecolabel'],
					['name' => 'Green Globe','description' => 'Green Globe'],
					['name' => 'The Green Key','description' => 'The Green Key'],
					['name' => 'Travelife','description' => 'Travelife'],
					['name' => 'World Of Glamping','description' => 'World Of Glamping'],
					
        	]);
    }
}
