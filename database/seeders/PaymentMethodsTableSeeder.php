<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->truncate();

        DB::table('payment_methods')->insert([
        	['name' => 'Paypal', 'status' => 'Active'],
            ['name' => 'Stripe', 'status' => 'Active'],
            ['name' => 'Wallet', 'status' => 'Active'],
            ['name' => 'Bank', 'status' => 'Active'],
            ['name' => 'Crypto', 'status' => 'Active'],
            ['name' => 'BoxaWallet', 'status' => 'Active'],
        ]);
    }
}
