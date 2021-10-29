<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmericanWaterBoTrackerList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
