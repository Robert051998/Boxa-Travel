<?php

/**
 * PasswordResets Model
 *
 * PasswordResets Model manages PasswordResets operation.
 *
 * @category   Language

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table   = 'password_resets';

    public $timestamps = false;
}
