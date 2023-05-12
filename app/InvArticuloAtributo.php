<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InvEspecificacion;

class InvArticuloAtributo extends Model
{
    protected $table = 'inv_articulo_atributo';


    public function especificaciones()
    {
        return $this->belongsToMany(InvEspecificacion::class,'inv_especificacions','inv_especificacions.id_articulo');
    }
}
