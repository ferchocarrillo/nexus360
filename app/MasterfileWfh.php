<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterfileWfh extends Model
{
    protected $fillable = [
        'employee_id','wfh','created_by'
    ];
}
