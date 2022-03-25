<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriviaQuestion extends Model
{
    public $timestamps = false;
    protected $fillable = ['question','is_enabled'];

    public function options(){
        return $this->hasMany('App\TriviaOption','question_id');
    }
}
