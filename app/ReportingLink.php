<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportingLink extends Model
{
    public $timestamps = false;

    protected $fillable = [

        'report',
        'campaign',
        'name',
        'url',
        'logo'
    ];



}
