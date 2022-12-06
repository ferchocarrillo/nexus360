<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaizenList extends Model
{
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
