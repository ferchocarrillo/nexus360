<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{
    protected $fillable = [
        'code',
        'name',
        'created_by',
        'started_at',
        'end_date',
        'time_limit_question',
        'is_enabled'
    ];

    protected $appends = ['status'];

    public function questions(){
        return $this->hasMany('App\TriviaQuestion');
    }

    public function answers(){
        return $this->hasMany('App\TriviaAnswer');
    }

    public function getStatusAttribute(){
        $status = 'In progress';
        $today = date('Y-m-d');
        if(!$this->is_enabled){
            $status = 'Disabled';
        }else if($this->started_at > $today){
            $status = 'Not started';
        }else if($this->end_date < $today){
            $status = 'Finalized';
        }
        return $status;
    }
}
