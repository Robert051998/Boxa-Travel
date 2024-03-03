<?php

/**
 * PropertyDates Model
 *
 * PropertyDates Model manages PropertyDates operation.
 *
 * @category   PropertyDates

 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PropertyDates extends Model
{
    protected $table    = 'property_dates';
    protected $fillable = ['property_id', 'status', 'date', 'min_day', 'min_stay', 'price','color','type'];

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }

    public static function getTempDates() {
        $data = Cache::get(config('cache.prefix') . '.calc.property_price');
        if (empty($data)) {
            $data = PropertyDates::all();
            Cache::put(config('cache.prefix') . '.calc.property_price', $data, 30 * 86400);
        }
        return $data;
    }
}
