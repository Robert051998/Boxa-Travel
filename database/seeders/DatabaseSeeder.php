<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(AdminTableSeeder::class);
        $this->call(AmenityTypeTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(BedTypeTableSeeder::class);
        $this->call(CertificationTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(MessageTypeTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(PropertyFeesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(SeoMetasTableSeeder::class);        
        $this->call(SettingsTableSeeder::class);
        $this->call(StartingCitiesTableSeeder::class);
        $this->call(StartingCitiesTableSeeder::class);
        $this->call(SpaceTypeTableSeeder::class);
        $this->call(TestimonialTableSeeder::class);
        $this->call(TimezoneTableSeeder::class);
        if (env('APP_ENV') == 'local') {
            $this->call(UserTableSeeder::class);
        }
    }
}
