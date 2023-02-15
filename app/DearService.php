<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DearService extends Model
{
   protected $table = 'dear_services_tracker';
    protected $fillable = [
        "custumer_name",
        "phone_number",
        "disposition",
        "call_attempts",
        "comments",
        "created_by",
    ];

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
