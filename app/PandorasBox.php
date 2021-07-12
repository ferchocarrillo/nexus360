<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PandorasBox extends Model
{
    protected $fillable = [
        'suggestion','category','created_by'
    ];

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
