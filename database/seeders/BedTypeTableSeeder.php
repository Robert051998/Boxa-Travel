<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BedTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bed_types')->truncate();
    	
        DB::table('bed_types')->insert([
            ['name' => 'king'],
            ['name' => 'Queen'],
            ['name' => 'Double'],
            ['name' => 'Single'],
            ['name' => 'Sofa bed'],
            ['name' => 'Sofa'],
            ['name' => 'Sofa bed'],
            ['name' => 'Bunk bed'],
            ['name' => 'Air mattress'],
            ['name' => 'Floor mattress'],
            ['name' => 'Toddler bed'],
            ['name' => 'Crib'],
            ['name' => 'Water bed'],
            ['name' => 'Hammock'],
        ]);
    }
}
