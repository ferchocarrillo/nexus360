<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustmentException extends Model
{
    protected $connection = 'sqlsrvpayroll';

    protected $fillable = [
        "employee_id",
        "payroll_id",
        "date",
        "created_by",
    ];
}
