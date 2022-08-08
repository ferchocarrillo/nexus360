<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollDayOffDiscount extends Model
{
    protected $connection = 'sqlsrvpayroll';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'date',
        'date_of_absence',
    ];
}
