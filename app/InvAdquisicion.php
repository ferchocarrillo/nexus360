<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvAdquisicion extends Model
{
    protected $table = 'inv_adquisicions';

    protected $casts = [
        'atributos' => 'array'
    ];
    protected $fillable = [
        'tipo_entrada', 'bodega',  'nit',  'n_factura',  'estado',  'tipo_requerimiento',  'articulo',  'id_articulo',  'codigo', 'atributos',  'descripcion',  'costo_unitario',  'anulado',  'numero_requerimiento','asignado','id_asignacion','baja'
    ];

    public function asignacion(){
        return $this->hasOne('App\InvAsignacion','id','id_asignacion');
    }

    public function asignaciones(){
        return $this->hasMany('App\InvAsignacion','id_activo','id');
    }
}
