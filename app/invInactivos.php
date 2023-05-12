<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invInactivos extends Model
{
    protected $primaryKey = 'id'; // Clave primaria

    public $timestamps = false;

    // Columnas de la tabla
    protected $fillable = ['id','articulo','codigo','anulado'];


//     public function articulos()
// {
//     return $this->belongsToMany(InvArticulos::class);
// }

    public function atributos()
    {
        return $this->belongsToMany('App\InvAtributo','inv_articulo_atributo','articulo_id','atributo_id');
    }
}
