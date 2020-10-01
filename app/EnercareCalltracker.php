<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnercareCalltracker extends Model
{
    protected $fillable = [
        'site_id', 'username', 'category', 'subcategory', 'reason_not_pitch','reason_not_sale'
    ];
}
