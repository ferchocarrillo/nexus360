<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmericanWaterFieldSupportTracker extends Model
{
    protected $table = 'american_water_field_support_trackers';

    protected $fillable = [
        'claim_number',
        'threshold',
        'status',
        'observations',
        'case_actioned',
        'created',
        'modified',
        'created_by'


    ];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';


    public function creador(){
        return $this->belongsTo('App\User','created_by');
    }
}
