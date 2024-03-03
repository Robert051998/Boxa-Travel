<?php

/**
 * RoleAdmin Model
 *
 * RoleAdmin Model manages RoleAdmin operation.
 *
 * @category   RoleAdmin

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RoleAdmin extends Model
{
    protected $table     = 'role_admin';
    protected $fillable  = ['role_id', 'admin_id'];
    public $timestamps   = false;

    protected $primaryKey = null;
    public $incrementing = false;

    public static function getAll()
    {
        $data = Cache::get(config('cache.prefix') . '.role_admin');
        if (empty($data)) {
            $data = parent::all();
            Cache::forever(config('cache.prefix') . '.role_admin', $data);
        }
        return $data;
    }
}
