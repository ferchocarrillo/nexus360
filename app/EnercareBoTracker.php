<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareBoTracker extends Model
{
    protected $table = 'enercare_bo_trackers';

    protected $fillable = [
        'lob',
        'queue_tracker',
        'case',
        'case_actioned',
        'created',
        'modified',
        'created_by',
        'call_centre',

    ];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';


    public function creador(){
        return $this->belongsTo('App\User','created_by');
    }

}
