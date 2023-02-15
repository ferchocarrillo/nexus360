<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DearServiceList extends Model
{
    protected $table = 'dear_service_list';
    public $timestamps = false;

    protected $casts = [
        'list' => 'array'
    ];
}
