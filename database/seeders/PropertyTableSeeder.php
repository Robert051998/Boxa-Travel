<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property                  = new Properties;
        $property->host_id         = User::first();
        $property->name            = SpaceType::getAll()->find($request->space_type)->name.' in '.$request->city;
        $property->slug            = $this->helper->pretty_url($property->name);
        $property->property_type   = $request->property_type_id;
        $property->space_type      = $request->space_type;
        $property->accommodates    = $request->accommodates;
        $property->save();

        $property_address                 = new PropertyAddress;
        $property_address->property_id    = $property->id;
        $property_address->address_line_1 = $request->route;
        $property_address->city           = $request->city;
        $property_address->state          = $request->state;
        $property_address->country        = $request->country;
        $property_address->postal_code    = $request->postal_code;
        $property_address->latitude       = $request->latitude;
        $property_address->longitude      = $request->longitude;
        $property_address->save();

        $property_price                 = new PropertyPrice;
        $property_price->property_id    = $property->id;
        $property_price->currency_code  = \Session::get('currency');
        $property_price->save();

        $property_steps                   = new PropertySteps;
        $property_steps->property_id      = $property->id;
        $property_steps->save();

        $property_description              = new PropertyDescription;
        $property_description->property_id = $property->id;
        $property_description->save();
    }
}
