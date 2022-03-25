<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriviaAnswer extends Model
{
    protected $fillable = [
        'trivia_id', 'question_id', 'option_id', 'is_correct', 'seconds','created_by'
    ];

    public function trivia(){
        return $this->belongsTo('App\Trivia');
    }

    public function question(){
        return $this->belongsTo('App\TriviaQuestion');
    }

    public function option(){
        return $this->belongsTo('App\TriviaOption');
    }

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
