<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CgmQaRating extends Model
{
    protected $fillable = [
        'id','qa_id','appointment_id','details_confirmed_via_call','voice_recording_sent','accepted_calendar_invite'
    ];
}
