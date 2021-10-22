<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollNovelty extends Model
{
    protected $fillable= [
        "employee_id",
        "national_id",
        "pep",
        "full_name",
        "date_of_hire",
        "campaign",
        "eps",
        "supervisor",
        "basic_salary_cop",
        "tag",
        "contingency",
        "cie10",
        "cie10_description",
        "start_date",
        "end_date",
        "days_hours",
        "extension",
        "extension_id",
        "status",
        "payroll_date",
        "days_to_recover",
        "date_of_filing",
        "recognized_value",
        "date_of_deposit",
        "observation",
        "created_by"
    ];

    public function creator(){
        return $this->hasOne('App\User','id','created_by');
    }

 
}
