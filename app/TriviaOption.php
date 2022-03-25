<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriviaOption extends Model
{
    public $timestamps = false;
    protected $hidden = ['is_correct'];
    protected $fillable = ['option','is_correct', 'is_enabled'];

    protected $casts = [
        'is_correct' => 'boolean',
        'is_enabled' => 'boolean',
    ];
}
