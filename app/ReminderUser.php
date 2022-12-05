<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderUser extends Model
{

    protected $fillable = [
        'reminder_id',
        'user_id',
        'acknowledge_required',
        'acknowledge'
    ];

    protected $casts = [
        'acknowledge_required' => 'boolean',
        'acknowledge' => 'boolean',
    ];

    public function reminder()
    {
        return $this->belongsTo('App\Reminder');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function masterfile2(){
        return $this->hasMany(MasterFile::class,'national_id','national_id')->orderBy('joining_date','DESC') ;
    }



}
