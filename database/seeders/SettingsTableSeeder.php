<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
        	['name' => 'name', 'value' => 'Boxa', 'type' => 'general'],
        	['name' => 'email', 'value' => '', 'type' => 'general'],
            ['name' => 'logo', 'value' => 'logo.png', 'type' => 'general'],
            ['name' => 'favicon', 'value' => 'favicon.png', 'type' => 'general'],
            ['name' => 'head_code', 'value' => '', 'type' => 'general'],
            ['name' => 'default_currency', 'value' => 1, 'type' => 'general'],
            ['name' => 'default_language', 'value' => 1, 'type' => 'general'],
            ['name' => 'email_logo', 'value' => 'email_logo.png', 'type' => 'general'],

            ['name' => 'username', 'value' => '', 'type' => 'PayPal'],
            ['name' => 'password', 'value' => '', 'type' => 'PayPal'],
            ['name' => 'signature', 'value' => '', 'type' => 'PayPal'],
            ['name' => 'mode', 'value' => 'sandbox', 'type' => 'PayPal'],
            ['name' => 'paypal_status', 'value' => '1', 'type' => 'PayPal'],

            ['name' => 'publishable', 'value' => '', 'type' => 'Stripe'],
            ['name' => 'secret', 'value' => '', 'type' => 'Stripe'],
            ['name' => 'stripe_status', 'value' => '1', 'type' => 'Stripe'],
                        
            ['name' => 'crypto_status', 'value' => '1', 'type' => 'WalletConnect'],
            ['name' => 'crypto_boxa_price', 'value' => '0.0000008460373454053832', 'type' => 'WalletConnect'],
            ['name' => 'crypto_boxa_expiry', 'value' => date('Y-m-d H:i:s'), 'type' => 'WalletConnect'],


            ['name' => 'driver', 'value' => 'sendmail', 'type' => 'email'],
            ['name' => 'host', 'value' => '', 'type' => 'email'],
            ['name' => 'port', 'value' => '', 'type' => 'email'],
            ['name' => 'from_address', 'value' => '', 'type' => 'email'],
            ['name' => 'from_name', 'value' => '', 'type' => 'email'],
            ['name' => 'encryption', 'value' => '', 'type' => 'email'],
            ['name' => 'username', 'value' => '', 'type' => 'email'],
            ['name' => 'password', 'value' => '', 'type' => 'email'],

            ['name' => 'facebook', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'google_plus', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'twitter', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'linkedin', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'pinterest', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'youtube', 'value' => '#', 'type' => 'join_us'],
            ['name' => 'instagram', 'value' => '#', 'type' => 'join_us'],

            ['name' => 'key', 'value' => 'AIzaSyCuVQYEG009F4MYeSRGHBZ0fdZZTIVxVHQ', 'type' => 'googleMap'],

            ['name' => 'client_id', 'value' => '148293337309-dsstdlk405l7c4qfh9f407l757uut7vp.apps.googleusercontent.com', 'type' => 'google'],
            ['name' => 'client_secret', 'value' => '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', 'type' => 'google'],

            ['name' => 'client_id', 'value' => '498917055703288', 'type' => 'facebook'],
            ['name' => 'client_secret', 'value' => '0bd8fea3ac15b19a961b5d1c13e1a061', 'type' => 'facebook'],
            ['name' => 'email_status', 'value' => '0', 'type' => 'email'],
            ['name' => 'row_per_page', 'value' => '25', 'type' => 'preferences'],
            ['name' => 'date_separator', 'value' => '-', 'type' => 'preferences'],
            ['name' => 'date_format', 'value' => '2', 'type' => 'preferences'],
            ['name' => 'dflt_timezone', 'value' => 'Asia/Karachi', 'type' => 'preferences'],
            ['name' => 'money_format', 'value' => 'before', 'type' => 'preferences'],
            ['name' => 'date_format_type', 'value' => 'mm-dd-yyyy', 'type' => 'preferences'],
            ['name' => 'front_date_format_type', 'value' => 'mm-dd-yy', 'type' => 'preferences'],
            ['name' => 'search_date_format_type', 'value' => 'm-d-yy', 'type' => 'preferences'],
            ['name' => 'min_search_price', 'value' => 1, 'type' => 'preferences'],
            ['name' => 'max_search_price', 'value' => 1000, 'type' => 'preferences'],
            ['name' => 'facebook_login', 'value' => 1, 'type' => 'social'],
            ['name' => 'google_login', 'value' => 1, 'type' => 'social'],

        ]);
    }
}
