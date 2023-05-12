<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invBajaStock extends Model
{
    protected $table='inv_baja_stocks';

protected $fillable = [
    'motivo',
    'articulo',
    'id_asignacion',
    'full_name',
    'position',
    'phone_number',
    'site',
    'wave',
    'descripcion',
    'observacion'
];

public function asignados()
{
    return $this->belongsToMany(MasterFile::class,'master_files','inv_baja_stocks.id_asignacion');
}

}
