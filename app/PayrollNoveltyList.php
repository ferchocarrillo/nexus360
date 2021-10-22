<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollNoveltyList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
