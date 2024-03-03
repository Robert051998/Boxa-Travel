<?php

/**
 * Banners Model
 *
 * Banners Model manages Banners operation.
 *
 * @category   Banners

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table    = 'banners';
    public $timestamps  = false;
    public $appends     = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image'];
    }
}
