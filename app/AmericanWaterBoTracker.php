<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmericanWaterBoTracker extends Model
{
    protected $fillable = [
        'username',
        'queue',
        'cus_id',
        'customer_name',
        'spreadsheet',
        'status',
        'enr_number',
        'agreement_classification',
        'additional_notes',
        'started_at',
        'view',
    ];
}
