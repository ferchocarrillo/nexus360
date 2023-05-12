<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invConsultaStock extends Model
{
    protected $table = 'inv_adquisicions';

    protected $fillable = [
        'tipo_entrada', 'bodega',  'nit',  'n_factura',  'estado',  'tipo_requerimiento',  'articulo',  'id_articulo',  'codigo', 'atributos',  'descripcion',  'costo_unitario',  'anulado',  'numero_requerimiento'
    ];
    protected $guarded = ['id'];
}
