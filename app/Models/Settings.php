<?php

/**
 * Settings Model
 *
 * Settings Model manages Settings operation.
 *
 * @category   Settings

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Settings extends Model
{
    protected $table    = 'settings';
    public $timestamps  = false;

    protected $fillable = ['value'];

    public static function getAll()
    {
        $data = Cache::get(config('cache.prefix') . '.settings');
        if (empty($data)) {
            $data = parent::all();
            Cache::put(config('cache.prefix') . '.settings', $data, 30 * 86400);
        }
        return $data;
    }
}
