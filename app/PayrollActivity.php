<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollActivity extends Model
{
    protected $connection = 'sqlsrvpayroll';

    public $timestamps = false;

    protected $appends = ['adjustment_type'];

    protected $fillable = [
        'code',
        'payroll_id',
        'activity_id',
        'employee_id',
        'date',
        'activity_type',
        'activity_name',
        'surcharge',
        'start_date',
        'end_date',
        'total_time_in_seconds',
    ];

    public function adjustments(){
        // relationship one to one by activity_code
        return $this->hasMany('App\PayrollAdjustment', 'activity_code', 'code');
    }

    public function payroll(){
        return $this->belongsTo('App\Payroll', 'payroll_id');
    }

    public function getAdjustmentTypeAttribute(){
        $adjustment = $this->adjustments->last();
        if($adjustment && $adjustment->status == PayrollAdjustment::APPROVED_STATUS){
            return $adjustment->adjustment_type;
        }
        return null;
    }

    
    public static $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    protected function getArrayableAppends()
    {
        if (self::$withoutAppends){
            return [];
        }

        return parent::getArrayableAppends();
    }

}
