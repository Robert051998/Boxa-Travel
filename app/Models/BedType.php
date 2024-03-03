<?php

/**
 * BedType Model
 *
 * BedType Model manages BedType operation.
 *
 * @category   BedType

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BedType extends Model
{
    protected $table    = 'bed_types';
    public $timestamps  = false;

    public static function getAll()
    {
        $data = Cache::get(config('cache.prefix') . '.property.types.bed');
        if (empty($data)) {
            $data = parent::all();
            Cache::forever(config('cache.prefix') . '.property.types.bed', $data);
        }
        return $data;
    }
}
