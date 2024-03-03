<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('email_templates')->truncate();

        DB::table('email_templates')->insert([
            ['temp_id' 	=> 1,
            'subject' 	=> "Account Information Updated",
            'body' 		=> "Dear {first_name},
            <br><br>
            We would like to confirm that your account information has been successfully updated. Please review the following information to ensure it is accurate:
            <br>
            Name:{first_name}
            <br>
            Email Address: {email}
            <br>
            Phone Number: {phone}
            <br>
            Billing Address: {address}
            <br><br>
            If any of the information listed above is incorrect, please log into your account and update it accordingly.
            <br><br>
            If you did not make any changes to your account information recently, or if you notice any suspicious activity on your account, please contact our customer support team immediately at support@boxatravel.com.
            <br><br>
            Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you plan your next travel adventure!
            <br><br>
            Best regards,
            <br><br>
            Boxa Travel Team.",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 2,
            'subject' 	=> "Your Payout information has been updated in {site_name}",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your {site_name} payout information was updated on {date_time}.<br>",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 3,
            'subject' 	=> "Your Payout information has been deleted in {site_name}",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your {site_name} payout information was deleted on {date_time}.<br>",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 4,
            'subject' 	=> "New Booking Received for {property_name}",
            'body' 		=> "Hi {owner_first_name},
            <br><br>
We are writing to inform you that a new booking has been made for your property, {property_name}. Here are the details of the booking:

            <br>
Booking reference: {booking_code}
<br>
Traveler's Name: {user_first_name}
<br>
Check-in Date: {start_date}
<br>
Check-out Date: {end_date} 
<br>
Number of Guests: {total_guest}
<br>
If you have any questions or concerns about the booking, please contact our customer support team at support@boxatravel.com.
<br>
Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you provide a memorable experience for your guests!
<br>
Best regards,
<br>
Boxa Travel Team.",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 5,
            'subject' 	=> "Confirm Your Email Address with Boxa Travel",
            'body' 		=> "Dear {first_name},
                            <br><br>
                            Thank you for creating an account with Boxa Travel! To ensure that we have your correct email address on file, we need you to confirm it by clicking on the button below:
                            <br><br>
                            Please note that you will not be able to make any bookings or receive important updates about your account until your email address has been confirmed.
                            <br><br>
                            If you did not create an account with Boxa Travel, or if you received this email in error, please disregard this message and contact our customer support team at support@boxatravel.com.
                            <br><br>
                            Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you plan your next adventure!

                            ",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 6,
            'subject' 	=> "Reset your Password",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your requested password reset link is below. If you didn't make the request, just ignore this email.",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 7,
            'subject' 	=> "Please set a payment account",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Amount {currency_symbol}{payout_amount} is waiting for you but you did not add any payout account to send the money. Please add a payout method.",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 8,
            'subject' 	=> "Payout Sent",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            We've issued you a payout of  {currency_symbol}{payout_amount} via PayPal. This payout should arrive in your account, taking into consideration weekends and holidays.",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=> 1],

            ['temp_id' 	=> 9,
            'subject' 	=> "Booking Cancelled",
            'body' 		=> "Dear {user_first_name},
            <br><br>
We are sorry to inform you that your booking with Boxa Travel for the following reservation has been cancelled:
            <p>Booking reference: {booking_code}</p>
            <p>Traveler's Name: {user_first_name}</p>
            <p>Departure Date: {start_date}</p>
            <p>Destination: {property_address}</p>
            <p>Accommodation: {property_name}</p>
            <p>Room Type: {property_type}</p>
            <p>Number of Rooms: {number_of_rooms}</p>
            <p>Duration of Stay: {total_night}</p>
            <p>Total Cost: {total_amount}</p>
            We understand that plans can change unexpectedly, and we respect your decision to cancel your reservation. Please note that any applicable refunds will be issued according to the terms and conditions of the accommodation provider.

            <br><br>                            
If you have any questions or concerns regarding your cancellation or refund, please contact our customer support team at support@boxatravel.com. We are available 24/7 to assist you.

<br><br>                            
            We hope to have the opportunity to assist you with your future travel plans. Thank you for choosing Boxa Travel.

            <br><br>                                                        
            Best regards,
            <br><br>
            Boxa Travel Team.<br>",
            'lang' 		=> 'en',
            'type' 		=> 'email',
            'lang_id' 	=>  1],

            ['temp_id'  => 10,
            'subject'   => "Booking {Accepted/Declined}",
            'body'      => "Hi {guest_first_name},
                            <br><br>
                            {host_first_name} {Accepted/Declined} the booking of {property_name}.<br>",
            'lang'      => 'en',
            'type'      => 'email',
            'lang_id'   => 1],

            ['temp_id'     => 11,
            'subject'   => "Booking Confirmation ({booking_code})",
            'body'      => "Dear {user_first_name},
                            <br><br>
                            Thank you for choosing Boxa Travel as your preferred travel platform. We are delighted to confirm your booking as follows:
                            <br><br>
                            <h1>Booking reference: {booking_code}</h1>
                            <br><br>
                            <h1>Traveler's Name: {user_first_name}</h1>
                            <br><br>
                            <h1>Departure Date: {start_date}</h1>
                            <br><br>
                            <h1>Destination: {property_address}</h1>
                            <br><br>
                            <h1>Accommodation: {property_name}</h1>
                            <br><br>
                            <h1>Room Type: {property_type}</h1>
                            <br><br>
                            <h1>Number of Rooms: {number_of_rooms}</h1>
                            <br><br>
                            <h1>Duration of Stay: {total_night}</h1>
                            <br><br>
                            <h1>Total Cost: {total_amount}</h1>
                            <br><br>
                            <br><br>
                            Please note that your booking is subject to the terms and conditions of the accommodation provider. Any changes or cancellations must be made in accordance with their policy.
                            <br><br>                            
                            This is an automated email, so please do not reply to it. If you have any questions or concerns regarding your booking, please contact our customer support team at support@boxatravel.com. We are available 24/7 to assist you.
                            <br><br>                            
                            Thank you again for choosing Boxa Travel. We look forward to helping you plan your next travel adventure!
                            <br><br>                                                        
                            Best regards,
                            <br><br>
                            Boxa Travel Team.
                            <br><br>
                            <br><br>
                            ",
            'lang'      => 'en',
            'type'      => 'email',
            'lang_id'   => 1],

        ]);
    }
}
