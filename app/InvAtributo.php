<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvAtributo extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'id',
        'atributo'
    ];

    public function especificaciones()
    {
        return $this->hasMany(InvEspecificacion::class,'id_atributo');
    }

}
