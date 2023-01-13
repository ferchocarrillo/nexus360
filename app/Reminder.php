<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        "reminder","campaign","created_by"
    ];

    public function recipients(){
        return $this->hasMany('App\ReminderUser');
    }

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
