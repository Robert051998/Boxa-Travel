<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxalog extends Model
{

    use HasFactory;
    protected $table = 'boxa_logs';
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
