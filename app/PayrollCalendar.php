<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollCalendar extends Model
{
    protected $connection = 'sqlsrvpayroll';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'day',
        'day_name',
        'week',
        'iso_week',
        'day_of_week',
        'q',
        'month',
        'month_name',
        'first_of_month',
        'last_of_month',
        'year',
        'day_of_year',
        'holiday',
        'holiday_description',
        'closed',
        'active'
    ];

    protected $casts = [
        'holiday' => 'boolean',
        'closed' => 'boolean',
        'active' => 'boolean'
    ];
}
