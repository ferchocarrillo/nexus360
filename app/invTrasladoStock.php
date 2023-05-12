<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invTrasladoStock extends Model
{
    protected $table = 'inv_adquisicions'; // Nombre de la tabla

protected $fillable =['bodega'];
}
