<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustmentType extends Model
{
    protected $connection = 'sqlsrvpayroll';

    public $timestamps = false;

    protected $fillable = [
        'activity_type',
        'adjustment_type',
        'approve_by_om',
        'justification',
        'active'
    ];

    protected $casts = [
        'approve_by_om' => 'boolean',
        'active' => 'boolean'
    ];

}
