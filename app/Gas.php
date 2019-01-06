<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gas extends Model
{
    protected $fillable = [
        'last_week_price', 'current_price', 'isIncrease', 'petrol_type', 'brand_name', 'note',
    ];
}
