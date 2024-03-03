<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Amenities;
use App\Models\Properties;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $properties = Properties::all();
        foreach($properties as $property) {
            $eco_friendly_amenities = Amenities::eco_friendly($property->id);
            $eco_amenities_count = 0;
            foreach($eco_friendly_amenities as $eco_amenity ) {
                if (!is_null ($eco_amenity->status)) {
                    $eco_amenities_count += 0.5;
                }
            }
            $property->green_score     = $eco_amenities_count;
            $property->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
