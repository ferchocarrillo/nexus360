<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaizenComment extends Model
{
    protected $fillable =[
        'comment','created_by','status'
    ];

    public function user(){
        return $this->belongsTo('App\User','created_by');
    }
}
