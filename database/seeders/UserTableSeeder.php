<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\{
    User,
    UserDetails,
    Messages,
    Country,
    PasswordResets,
    Payment,
    Notification,
    Timezone,
    Reviews,
    Accounts,
    UsersVerification,
    Properties,
    Payouts,
    Bookings,
    Currency,
    Settings,
    Wallet,
    Withdrawal
};

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->count(3)->create();
        // $user = new User;
        // $user->truncate();
        // $user->first_name   =   strip_tags('first_name');
        // $user->last_name    =   strip_tags('last_name');
        // $user->email        =   'test@email.com';
        // $user->password     =   bcrypt('password');
        // $user->status       =   'Active';
        // $formattedPhone        = ('+923331234567');
        // $user->phone           = preg_replace("/[\s-]+/", "", $formattedPhone);
        // $user->default_country = NULL;
        // $user->carrier_code    = NULL;
        // $user->formatted_phone = NULL;
        // $user->save();

        // $user_details             = new UserDetails;
        // $user_details->user_id    = $user->id;
        // $user_details->field      = 'date_of_birth';
        // $user_details->value      = '1998-01-03';
        // $user_details->save();

        // $user_verification  = new UsersVerification;
        // $user_verification->user_id  =   $user->id;
        // $user_verification->save();


        // $defaultCurrencyId    = Settings::all()->where('name', 'default_currency')->first();
        // $wallet               = new Wallet();
        // $wallet->user_id      = $user->id;
        // $wallet->currency_id  = (int)$defaultCurrencyId->value;
        // $wallet->save();
    }
}
