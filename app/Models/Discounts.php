<?php

/**
 * PropertyType Model
 *
 * PropertyType Model manages PropertyType operation.
 *
 * @category   PropertyType

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Discounts extends Model
{
    protected $table   = 'discounts';
    public $timestamps = false;

   
    public static function getAll()
    {        
        $data = parent::all()->sortBy('amount');
        return $data;
    }
}
