<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvProveedores extends Model
{
    protected $table = 'inv_proveedores'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Columnas de la tabla
    protected $fillable = ['nit','nombreEmpresa'];


}
