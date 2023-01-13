<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuurnTrackerList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
