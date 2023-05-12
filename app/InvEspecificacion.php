<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvEspecificacion extends Model
{
    protected $fillable = [
        'id',
        'id_atributo',
        'especificacion'
    ];


}
