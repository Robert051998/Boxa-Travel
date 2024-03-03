<?php

/**
 * Message Model
 *
 * Message Model manages Message operation.
 *
 * @category   Message

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    protected $table    = 'message_type';
    public $timestamps  = false;

    public function messages()
    {
        return $this->hasMany('App\Models\Messages', 'type_id', 'id');
    }
}
