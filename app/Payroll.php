<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $connection = 'sqlsrvpayroll';

    public $timestamps = false;

    protected $casts = [
        'schedule' => 'array',
        'novelty' => 'array',
        'is_holiday' => 'boolean',
    ];

    protected $fillable = [
        'employee_id',
        'national_id',
        'date',
        'day',
        'day_of_week',
        'is_holiday',
        'schedule',
        'novelty'
    ];

    // relationships one to many with payroll_activity on payroll_id
    public function payroll_activities()
    {
        return $this->hasMany('App\PayrollActivity', 'payroll_id', 'id');
    }

    public function calendar()
    {
        return $this->belongsTo('App\PayrollCalendar','date','date');
    }
    
}
