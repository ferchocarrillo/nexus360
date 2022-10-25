<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdmin extends Model
{
    protected $connection = 'sqlsrvpayroll';
    
    public $timestamps = false;

    protected $casts = [
        'value' => 'array'
    ];
}
