<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuurnTracker extends Model
{
    protected $table = 'moduurn_calltrackers';

    protected $fillable = [
        'phone_number1',
        'phone_number2',
        'list_id',
        'not_show',
        'is_schedule',
        'reason_not_schedule',
        'type',
        'transfer_call',
        'date_schedule',
        'region',
        'country',
        'state',
        'expert',
        'created_by',
    ];

    protected $dates = ['date_schedule'];


    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
