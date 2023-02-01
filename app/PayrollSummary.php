<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSummary extends Model
{
    protected $connection = 'sqlsrvpayroll';
    
    public $timestamps = false;

    protected $fillable = [
        'date',
        'employee_id',
        'national_id',
        'novelty',
        'novelty_id',
        'start_date',
        'end_date',
        'total_time_in_seconds',
    ];
}
