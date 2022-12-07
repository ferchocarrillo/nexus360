<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustment extends Model
{
    protected $connection = 'sqlsrvpayroll';

    protected $appends = ['icon_status'];

    // APPROVAL_STATUSES
    const APPROVAL_STATUSES = [
        'Aprobado' => 'Aprobado',
        'Rechazado' => 'Rechazado'
    ];

    const ICON_STATUS = [
        'Pendiente' => '<i class="fas fa-exclamation-circle text-info"></i>',
        'Aprobado' => '<i class="fas fa-check-circle text-success"></i>',
        'Rechazado' => '<i class="fas fa-times-circle text-danger"></i>'
    ];

    const APPROVED_STATUS = 'Aprobado';


    protected $fillable = [
        'activity_code',
        'employee_id',
        'adjustment_type',
        'justification',
        'observations',
        'supervisor_approval_required',
        'supervisor_approval_status',
        'supervisor_approval_date',
        'supervisor_approval_user_id',
        'supervisor_approval_comment',
        'om_approval_required',
        'om_approval_status',
        'om_approval_date',
        'om_approval_user_id',
        'om_approval_comment',
        'created_by',
        'payroll_id',
        'date',
        'status',
        'approved_time',
    ];

    protected $casts = [
        'supervisor_approval_required' => 'boolean',
        'om_approval_required' => 'boolean',
    ];

    public function getIconStatusAttribute()
    {
        return ($this->status ? self::ICON_STATUS[$this->status] : '');
    }

    public function payroll_activity(){
        return $this->hasOne('App\PayrollActivity', 'code', 'activity_code');
    }
    
    public function supervisor(){
        return $this->belongsTo('App\User', 'supervisor_id');
    }

    public function om(){
        return $this->belongsTo('App\User', 'om_id');
    }

    public function employee(){
        return $this->setConnection('sqlsrvnexus360')->belongsTo('App\MasterFile', 'employee_id');
    }

    public function creator(){
        return $this->setConnection('sqlsrvnexus360')->belongsTo('App\User', 'created_by');
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
