<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CgmAppointmentDisposition extends Model
{
    protected $fillable = [
        'name','required_appointment','required_date'
    ];
}
