<?php

/**
 * Certification Model
 *
 * Certification Model manages Certification operation.
 *
 * @category   Certification

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Certification extends Model
{
    protected $table   = 'certification';
    public $timestamps = false;

    public function properties()
    {
        return $this->hasMany('App\Models\Properties', 'certification', 'id');
    }

    public static function getAll()
    {        
        $data = parent::all();
        return $data;
    }
}
