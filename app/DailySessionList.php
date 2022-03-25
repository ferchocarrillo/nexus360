<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySessionList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
