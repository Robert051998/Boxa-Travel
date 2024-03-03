<?php

/**
 * Notifications Model
 *
 * Notifications Model manages Notifications operation.
 *
 * @category   Notifications

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
