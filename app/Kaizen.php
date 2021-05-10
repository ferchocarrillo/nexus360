<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kaizen extends Model
{
    protected $fillable = [
        'title','group','campaign','type','schedules','file_path','description','required_by','assigned_to','status','deadline'
    ];

    public function assigned(){
        return $this->belongsTo('App\User','assigned_to');
    }
    
    public function required(){
        return $this->belongsTo('App\User','required_by');
    }

    public function comments()
    {
        return $this->hasMany('App\KaizenComment','kaizen_id');
    }
}
