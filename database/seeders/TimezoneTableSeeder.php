<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TimezoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timezone')->truncate();
        DB::table('timezone')->insert([
            ['zone' => '(GMT-11:00) International Date Line West', 'value' => 'Pacific/Kwajalein'],
            ['zone' => '(GMT-11:00) Midway Island', 'value' => 'Pacific/Midway'],
            ['zone' => '(GMT-11:00) Samoa', 'value' => 'Pacific/Samoa'],
            ['zone' => '(GMT-10:00) Hawaii', 'value' => 'Pacific/Honolulu'],
            ['zone' => '(GMT-10:00) Pacific/Honolulu', 'value' => 'Pacific/Honolulu'],
            ['zone' => '(GMT-09:00) Alaska', 'value' => 'US/Alaska'],
            ['zone' => '(GMT-08:00) America/Los_Angeles', 'value' => 'America/Los_Angeles'],
            ['zone' => '(GMT-08:00) Pacific Time (US &amp; Canada)', 'value' => 'America/Los_Angeles'],
            ['zone' => '(GMT-08:00) Tijuana', 'value' => 'America/Tijuana'],
            ['zone' => '(GMT-07:00) America/Denver', 'value' => 'America/Denver'],
            ['zone' => '(GMT-07:00) America/Phoenix', 'value' => 'America/Phoenix'],
            ['zone' => '(GMT-07:00) Arizona', 'value' => 'US/Arizona'],
            ['zone' => '(GMT-07:00) Chihuahua', 'value' => 'America/Chihuahua'],
            ['zone' => '(GMT-07:00) Mazatlan', 'value' => 'America/Mazatlan'],
            ['zone' => '(GMT-07:00) Mountain Time (US &amp; Canada)', 'value' => 'US/Mountain'],
            ['zone' => '(GMT-06:00) America/Chicago', 'value' => 'America/Chicago'],
            ['zone' => '(GMT-06:00) America/Mexico_City', 'value' => 'America/Mexico_City'],
            ['zone' => '(GMT-06:00) Central America', 'value' => 'America/Managua'],
            ['zone' => '(GMT-06:00) Central Time (US &amp; Canada)', 'value' => 'US/Central'],
            ['zone' => '(GMT-06:00) Guadalajara', 'value' => 'America/Mexico_City'],
            ['zone' => '(GMT-06:00) Mexico City', 'value' => 'America/Mexico_City'],
            ['zone' => '(GMT-06:00) Monterrey', 'value' => 'America/Monterrey'],
            ['zone' => '(GMT-06:00) Saskatchewan', 'value' => 'Canada/Saskatchewan'],
            ['zone' => '(GMT-05:00) America/Nassau', 'value' => 'America/Nassau'],
            ['zone' => '(GMT-05:00) America/New_York', 'value' => 'America/New_York'],
            ['zone' => '(GMT-05:00) America/Port-au-Prince', 'value' => 'America/Port-au-Prince'],
            ['zone' => '(GMT-05:00) America/Toronto', 'value' => 'America/Toronto'],
            ['zone' => '(GMT-05:00) Bogota', 'value' => 'America/Bogota'],
            ['zone' => '(GMT-05:00) Eastern Time (US &amp; Canada)', 'value' => 'US/Eastern'],
            ['zone' => '(GMT-05:00) Indiana (East)', 'value' => 'US/East-Indiana'],
            ['zone' => '(GMT-05:00) Lima', 'value' => 'America/Lima'],
            ['zone' => '(GMT-05:00) Quito', 'value' => 'America/Bogota'],
            ['zone' => '(GMT-04:30) Caracas', 'value' => 'America/Caracas'],
            ['zone' => '(GMT-04:00) Atlantic Time (Canada)', 'value' => 'Canada/Atlantic'],
            ['zone' => '(GMT-04:00) Georgetown', 'value' => 'America/Argentina/Buenos_Aires'],
            ['zone' => '(GMT-04:00) La Paz', 'value' => 'America/La_Paz'],
            ['zone' => '(GMT-03:30) Newfoundland', 'value' => 'Canada/Newfoundland'],
            ['zone' => '(GMT-03:00) America/Argentina/Buenos_Aires', 'value' => 'America/Argentina/Buenos_Aires'],
            ['zone' => '(GMT-03:00) America/Cordoba', 'value' => 'America/Cordoba'],
            ['zone' => '(GMT-03:00) America/Fortaleza', 'value' => 'America/Fortaleza'],
            ['zone' => '(GMT-03:00) America/Montevideo', 'value' => 'America/Montevideo'],
            ['zone' => '(GMT-03:00) America/Santiago', 'value' => 'America/Santiago'],
            ['zone' => '(GMT-03:00) America/Sao_Paulo', 'value' => 'America/Sao_Paulo'],
            ['zone' => '(GMT-03:00) Brasilia', 'value' => 'America/Sao_Paulo'],
            ['zone' => '(GMT-03:00) Buenos Aires', 'value' => 'America/Argentina/Buenos_Aires'],
            ['zone' => '(GMT-03:00) Greenland', 'value' => 'America/Godthab'],
            ['zone' => '(GMT-03:00) Santiago', 'value' => 'America/Santiago'],
            ['zone' => '(GMT-02:00) Mid-Atlantic', 'value' => 'America/Noronha'],
            ['zone' => '(GMT-01:00) Azores', 'value' => 'Atlantic/Azores'],
            ['zone' => '(GMT-01:00) Cape Verde Is.', 'value' => 'Atlantic/Cape_Verde'],
            ['zone' => '(GMT+00:00) Africa/Casablanca', 'value' => 'Africa/Casablanca'],
            ['zone' => '(GMT+00:00) Atlantic/Canary', 'value' => 'Atlantic/Canary'],
            ['zone' => '(GMT+00:00) Atlantic/Reykjavik', 'value' => 'Atlantic/Reykjavik'],
            ['zone' => '(GMT+00:00) Casablanca', 'value' => 'Africa/Casablanca'],
            ['zone' => '(GMT+00:00) Dublin', 'value' => 'Etc/Greenwich'],
            ['zone' => '(GMT+00:00) Edinburgh', 'value' => 'Europe/London'],
            ['zone' => '(GMT+00:00) Europe/Dublin', 'value' => 'Europe/Dublin'],
            ['zone' => '(GMT+00:00) Europe/Lisbon', 'value' => 'Europe/Lisbon'],
            ['zone' => '(GMT+00:00) Europe/London', 'value' => 'Europe/London'],
            ['zone' => '(GMT+00:00) Lisbon', 'value' => 'Europe/Lisbon'],
            ['zone' => '(GMT+00:00) London', 'value' => 'Europe/London'],
            ['zone' => '(GMT+00:00) Monrovia', 'value' => 'Africa/Monrovia'],
            ['zone' => '(GMT+00:00) UTC', 'value' => 'UTC'],
            ['zone' => '(GMT+01:00) Amsterdam', 'value' => 'Europe/Amsterdam'],
            ['zone' => '(GMT+01:00) Belgrade', 'value' => 'Europe/Belgrade'],
            ['zone' => '(GMT+01:00) Berlin', 'value' => 'Europe/Berlin'],
            ['zone' => '(GMT+01:00) Bern', 'value' => 'Europe/Berlin'],
            ['zone' => '(GMT+01:00) Bratislava', 'value' => 'Europe/Bratislava'],
            ['zone' => '(GMT+01:00) Brussels', 'value' => 'Europe/Brussels'],
            ['zone' => '(GMT+01:00) Budapest', 'value' => 'Europe/Budapest'],
            ['zone' => '(GMT+01:00) Copenhagen', 'value' => 'Europe/Copenhagen'],
            ['zone' => '(GMT+01:00) Europe/Amsterdam', 'value' => 'Europe/Amsterdam'],
            ['zone' => '(GMT+01:00) Europe/Belgrade', 'value' => 'Europe/Belgrade'],
            ['zone' => '(GMT+01:00) Europe/Berlin', 'value' => 'Europe/Berlin'],
            ['zone' => '(GMT+01:00) Europe/Bratislava', 'value' => 'Europe/Bratislava'],
            ['zone' => '(GMT+01:00) Europe/Brussels', 'value' => 'Europe/Brussels'],
            ['zone' => '(GMT+01:00) Europe/Budapest', 'value' => 'Europe/Budapest'],
            ['zone' => '(GMT+01:00) Europe/Copenhagen', 'value' => 'Europe/Copenhagen'],
            ['zone' => '(GMT+01:00) Europe/Ljubljana', 'value' => 'Europe/Ljubljana'],
            ['zone' => '(GMT+01:00) Europe/Madrid', 'value' => 'Europe/Madrid'],
            ['zone' => '(GMT+01:00) Europe/Monaco', 'value' => 'Europe/Monaco'],
            ['zone' => '(GMT+01:00) Europe/Oslo', 'value' => 'Europe/Oslo'],
            ['zone' => '(GMT+01:00) Europe/Paris', 'value' => 'Europe/Paris'],
            ['zone' => '(GMT+01:00) Europe/Podgorica', 'value' => 'Europe/Podgorica'],
            ['zone' => '(GMT+01:00) Europe/Prague', 'value' => 'Europe/Prague'],
            ['zone' => '(GMT+01:00) Europe/Rome', 'value' => 'Europe/Rome'],
            ['zone' => '(GMT+01:00) Europe/Stockholm', 'value' => 'Europe/Stockholm'],
            ['zone' => '(GMT+01:00) Europe/Tirane', 'value' => 'Europe/Tirane'],
            ['zone' => '(GMT+01:00) Europe/Vienna', 'value' => 'Europe/Vienna'],
            ['zone' => '(GMT+01:00) Europe/Warsaw', 'value' => 'Europe/Warsaw'],
            ['zone' => '(GMT+01:00) Europe/Zagreb', 'value' => 'Europe/Zagreb'],
            ['zone' => '(GMT+01:00) Europe/Zurich', 'value' => 'Europe/Zurich'],
            ['zone' => '(GMT+01:00) Ljubljana', 'value' => 'Europe/Ljubljana'],
            ['zone' => '(GMT+01:00) Madrid', 'value' => 'Europe/Madrid'],
            ['zone' => '(GMT+01:00) Paris', 'value' => 'Europe/Paris'],
            ['zone' => '(GMT+01:00) Prague', 'value' => 'Europe/Prague'],
            ['zone' => '(GMT+01:00) Rome', 'value' => 'Europe/Rome'],
            ['zone' => '(GMT+01:00) Sarajevo', 'value' => 'Europe/Sarajevo'],
            ['zone' => '(GMT+01:00) Skopje', 'value' => 'Europe/Skopje'],
            ['zone' => '(GMT+01:00) Stockholm', 'value' => 'Europe/Stockholm'],
            ['zone' => '(GMT+01:00) Vienna', 'value' => 'Europe/Vienna'],
            ['zone' => '(GMT+01:00) Warsaw', 'value' => 'Europe/Warsaw'],
            ['zone' => '(GMT+01:00) West Central Africa', 'value' => 'Africa/Lagos'],
            ['zone' => '(GMT+01:00) Zagreb', 'value' => 'Europe/Zagreb'],
            ['zone' => '(GMT+02:00) Asia/Beirut', 'value' => 'Asia/Beirut'],
            ['zone' => '(GMT+02:00) Asia/Jerusalem', 'value' => 'Asia/Jerusalem'],
            ['zone' => '(GMT+02:00) Asia/Nicosia', 'value' => 'Asia/Nicosia'],
            ['zone' => '(GMT+02:00) Athens', 'value' => 'Europe/Athens'],
            ['zone' => '(GMT+02:00) Bucharest', 'value' => 'Europe/Bucharest'],
            ['zone' => '(GMT+02:00) Cairo', 'value' => 'Africa/Cairo'],
            ['zone' => '(GMT+02:00) Europe/Athens', 'value' => 'Europe/Athens'],
            ['zone' => '(GMT+02:00) Europe/Helsinki', 'value' => 'Europe/Helsinki'],
            ['zone' => '(GMT+02:00) Europe/Istanbul', 'value' => 'Europe/Istanbul'],
            ['zone' => '(GMT+02:00) Europe/Riga', 'value' => 'Europe/Riga'],
            ['zone' => '(GMT+02:00) Europe/Sofia', 'value' => 'Europe/Sofia'],
            ['zone' => '(GMT+02:00) Harare', 'value' => 'Africa/Harare'],
            ['zone' => '(GMT+02:00) Helsinki', 'value' => 'Europe/Helsinki'],
            ['zone' => '(GMT+02:00) Istanbul', 'value' => 'Europe/Istanbul'],
            ['zone' => '(GMT+02:00) Jerusalem', 'value' => 'Asia/Jerusalem'],
            ['zone' => '(GMT+02:00) Kyiv', 'value' => 'Europe/Helsinki'],
            ['zone' => '(GMT+02:00) Pretoria', 'value' => 'Africa/Johannesburg'],
            ['zone' => '(GMT+02:00) Riga', 'value' => 'Europe/Riga'],
            ['zone' => '(GMT+02:00) Sofia', 'value' => 'Europe/Sofia'],
            ['zone' => '(GMT+02:00) Tallinn', 'value' => 'Europe/Tallinn'],
            ['zone' => '(GMT+02:00) Vilnius', 'value' => 'Europe/Vilnius'],
            ['zone' => '(GMT+03:00) Baghdad', 'value' => 'Asia/Baghdad'],
            ['zone' => '(GMT+03:00) Europe/Minsk', 'value' => 'Europe/Minsk'],
            ['zone' => '(GMT+03:00) Europe/Moscow', 'value' => 'Europe/Moscow'],
            ['zone' => '(GMT+03:00) Kuwait', 'value' => 'Asia/Kuwait'],
            ['zone' => '(GMT+03:00) Minsk', 'value' => 'Europe/Minsk'],
            ['zone' => '(GMT+03:00) Moscow', 'value' => 'Europe/Moscow'],
            ['zone' => '(GMT+03:00) Nairobi', 'value' => 'Africa/Nairobi'],
            ['zone' => '(GMT+03:00) Riyadh', 'value' => 'Asia/Riyadh'],
            ['zone' => '(GMT+03:00) St. Petersburg', 'value' => 'Europe/Moscow'],
            ['zone' => '(GMT+03:00) Volgograd', 'value' => 'Europe/Volgograd'],
            ['zone' => '(GMT+03:30) Tehran', 'value' => 'Asia/Tehran'],
            ['zone' => '(GMT+04:00) Abu Dhabi', 'value' => 'Asia/Muscat'],
            ['zone' => '(GMT+04:00) Asia/Dubai', 'value' => 'Asia/Dubai'],
            ['zone' => '(GMT+04:00) Asia/Tbilisi', 'value' => 'Asia/Tbilisi'],
            ['zone' => '(GMT+04:00) Baku', 'value' => 'Asia/Baku'],
            ['zone' => '(GMT+04:00) Muscat', 'value' => 'Asia/Muscat'],
            ['zone' => '(GMT+04:00) Tbilisi', 'value' => 'Asia/Tbilisi'],
            ['zone' => '(GMT+04:00) Yerevan', 'value' => 'Asia/Yerevan'],
            ['zone' => '(GMT+04:30) Kabul', 'value' => 'Asia/Kabul'],
            ['zone' => '(GMT+05:00) Ekaterinburg', 'value' => 'Asia/Yekaterinburg'],
            ['zone' => '(GMT+05:00) Indian/Maldives', 'value' => 'Indian/Maldives'],
            ['zone' => '(GMT+05:00) Islamabad', 'value' => 'Asia/Karachi'],
            ['zone' => '(GMT+05:00) Karachi', 'value' => 'Asia/Karachi'],
            ['zone' => '(GMT+05:00) Tashkent', 'value' => 'Asia/Tashkent'],
            ['zone' => '(GMT+05:30) Asia/Calcutta', 'value' => 'Asia/Calcutta'],
            ['zone' => '(GMT+05:30) Asia/Colombo', 'value' => 'Asia/Colombo'],
            ['zone' => '(GMT+05:30) Chennai', 'value' => 'Asia/Calcutta'],
            ['zone' => '(GMT+05:30) Kolkata', 'value' => 'Asia/Kolkata'],
            ['zone' => '(GMT+05:30) Mumbai', 'value' => 'Asia/Calcutta'],
            ['zone' => '(GMT+05:30) New Delhi', 'value' => 'Asia/Calcutta'],
            ['zone' => '(GMT+05:30) Sri Jayawardenepura', 'value' => 'Asia/Calcutta'],
            ['zone' => '(GMT+05:45) Kathmandu', 'value' => 'Asia/Katmandu'],
            ['zone' => '(GMT+06:00) Almaty', 'value' => 'Asia/Almaty'],
            ['zone' => '(GMT+06:00) Astana', 'value' => 'Asia/Dhaka'],
            ['zone' => '(GMT+06:00) Dhaka', 'value' => 'Asia/Dhaka'],
            ['zone' => '(GMT+06:00) Novosibirsk', 'value' => 'Asia/Novosibirsk'],
            ['zone' => '(GMT+06:00) Urumqi', 'value' => 'Asia/Urumqi'],
            ['zone' => '(GMT+06:30) Rangoon', 'value' => 'Asia/Rangoon'],
            ['zone' => '(GMT+07:00) Asia/Bangkok', 'value' => 'Asia/Bangkok'],
            ['zone' => '(GMT+07:00) Asia/Jakarta', 'value' => 'Asia/Jakarta'],
            ['zone' => '(GMT+07:00) Bangkok', 'value' => 'Asia/Bangkok'],
            ['zone' => '(GMT+07:00) Hanoi', 'value' => 'Asia/Bangkok'],
            ['zone' => '(GMT+07:00) Jakarta', 'value' => 'Asia/Jakarta'],
            ['zone' => '(GMT+07:00) Krasnoyarsk', 'value' => 'Asia/Krasnoyarsk'],
            ['zone' => '(GMT+08:00) Asia/Chongqing', 'value' => 'Asia/Chongqing'],
            ['zone' => '(GMT+08:00) Asia/Hong_Kong', 'value' => 'Asia/Hong_Kong'],
            ['zone' => '(GMT+08:00) Asia/Kuala_Lumpur', 'value' => 'Asia/Kuala_Lumpur'],
            ['zone' => '(GMT+08:00) Asia/Macau', 'value' => 'Asia/Macau'],
            ['zone' => '(GMT+08:00) Asia/Makassar', 'value' => 'Asia/Makassar'],
            ['zone' => '(GMT+08:00) Asia/Shanghai', 'value' => 'Asia/Shanghai'],
            ['zone' => '(GMT+08:00) Asia/Taipei', 'value' => 'Asia/Taipei'],
            ['zone' => '(GMT+08:00) Beijing', 'value' => 'Asia/Hong_Kong'],
            ['zone' => '(GMT+08:00) Chongqing', 'value' => 'Asia/Chongqing'],
            ['zone' => '(GMT+08:00) Hong Kong', 'value' => 'Asia/Hong_Kong'],
            ['zone' => '(GMT+08:00) Irkutsk', 'value' => 'Asia/Irkutsk'],
            ['zone' => '(GMT+08:00) Kuala Lumpur', 'value' => 'Asia/Kuala_Lumpur'],
            ['zone' => '(GMT+08:00) Perth', 'value' => 'Australia/Perth'],
            ['zone' => '(GMT+08:00) Singapore', 'value' => 'Asia/Singapore'],
            ['zone' => '(GMT+08:00) Taipei', 'value' => 'Asia/Taipei'],
            ['zone' => '(GMT+08:00) Ulaan Bataar', 'value' => 'Asia/Ulan_Bator'],
            ['zone' => '(GMT+09:00) Asia/Seoul', 'value' => 'Asia/Seoul'],
            ['zone' => '(GMT+09:00) Asia/Tokyo', 'value' => 'Asia/Tokyo'],
            ['zone' => '(GMT+09:00) Osaka', 'value' => 'Asia/Tokyo'],
            ['zone' => '(GMT+09:00) Sapporo', 'value' => 'Asia/Tokyo'],
            ['zone' => '(GMT+09:00) Seoul', 'value' => 'Asia/Seoul'],
            ['zone' => '(GMT+09:00) Tokyo', 'value' => 'Asia/Tokyo'],
            ['zone' => '(GMT+09:00) Yakutsk', 'value' => 'Asia/Yakutsk'],
            ['zone' => '(GMT+09:30) Adelaide', 'value' => 'Australia/Adelaide'],
            ['zone' => '(GMT+09:30) Darwin', 'value' => 'Australia/Darwin'],
            ['zone' => '(GMT+10:00) Australia/Brisbane', 'value' => 'Australia/Brisbane'],
            ['zone' => '(GMT+10:00) Australia/Hobart', 'value' => 'Australia/Hobart'],
            ['zone' => '(GMT+10:00) Australia/Melbourne', 'value' => 'Australia/Melbourne'],
            ['zone' => '(GMT+10:00) Australia/Sydney', 'value' => 'Australia/Sydney'],
            ['zone' => '(GMT+10:00) Brisbane', 'value' => 'Australia/Brisbane'],
            ['zone' => '(GMT+10:00) Canberra', 'value' => 'Australia/Canberra'],
            ['zone' => '(GMT+10:00) Guam', 'value' => 'Pacific/Guam'],
            ['zone' => '(GMT+10:00) Hobart', 'value' => 'Australia/Hobart'],
            ['zone' => '(GMT+10:00) Magadan', 'value' => 'Asia/Magadan'],
            ['zone' => '(GMT+10:00) Melbourne', 'value' => 'Australia/Melbourne'],
            ['zone' => '(GMT+10:00) Port Moresby', 'value' => 'Pacific/Port_Moresby'],
            ['zone' => '(GMT+10:00) Solomon Is.', 'value' => 'Asia/Magadan'],
            ['zone' => '(GMT+10:00) Sydney', 'value' => 'Australia/Sydney'],
            ['zone' => '(GMT+10:00) Vladivostok', 'value' => 'Asia/Vladivostok'],
            ['zone' => '(GMT+11:00) New Caledonia', 'value' => 'Asia/Magadan'],
            ['zone' => '(GMT+12:00) Auckland', 'value' => 'Pacific/Auckland'],
            ['zone' => '(GMT+12:00) Fiji', 'value' => 'Pacific/Fiji'],
            ['zone' => '(GMT+12:00) Kamchatka', 'value' => 'Asia/Kamchatka'],
            ['zone' => '(GMT+12:00) Marshall Is.', 'value' => 'Pacific/Fiji'],
            ['zone' => '(GMT+12:00) Pacific/Auckland', 'value' => 'Pacific/Auckland'],
            ['zone' => '(GMT+12:00) Wellington', 'value' => 'Pacific/Auckland'],
            ['zone' => '(GMT+13:00) Nuku&#39;alofa', 'value' => 'Pacific/Tongatapu'],
        ]);
    }
}
