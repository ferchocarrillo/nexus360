<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareTrackerSupportFacilitatorList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
