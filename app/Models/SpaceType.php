<?php

/**
 * SpaceType Model
 *
 * SpaceType Model manages SpaceType operation.
 *
 * @category   SpaceType

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SpaceType extends Model
{
    protected $table   = 'space_type';
    public $timestamps = false;

    public static function getAll()
    {
        $data = Cache::get(config('cache.prefix') . '.property.types.space');
        if (empty($data)) {
            $data = parent::all();
            Cache::forever(config('cache.prefix') . '.property.types.space', $data);
        }
        return $data;
    }
}
