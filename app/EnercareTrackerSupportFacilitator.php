<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareTrackerSupportFacilitator extends Model
{
    protected $table = 'enercare_tracker_support_facilitators';
    protected $fillable = [
        'agent',
        'process',
        'process_specific',
        'additional_details',
        'behavior_identified',
        'recomendations',
        'repeated_interaction',
        'observations',
        'conference_in',
        'supervisor_assistence',
        'created_by',
    ];

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
