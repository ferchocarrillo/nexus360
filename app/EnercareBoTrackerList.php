<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareBoTrackerList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
