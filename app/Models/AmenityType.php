<?php

/**
 * AmenityType Model
 *
 * AmenityType Model manages AmenityType operation.
 *
 * @category   AmenityType

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmenityType extends Model
{
    protected $table    = 'amenity_type';
    public $timestamps  = false;

    public function amenities()
    {
        return $this->hasMany('App\Models\Amenities', 'type_id', 'id');
    }
}
