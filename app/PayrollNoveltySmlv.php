<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollNoveltySmlv extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'year';

    protected $appends = ['daily_salary'];

    protected $fillable = [
        'year', 'salary'
    ];

    public function getDailySalaryAttribute(){
        return round($this->salary/30,2);
    }
}
