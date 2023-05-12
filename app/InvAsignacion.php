<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvAsignacion extends Model
{
    protected $table = 'inv_asignacions';

    protected $fillable =
    [
        'motivo',
        'id_activo',
        'articulo',
        'full_name',
        'national_id',
        'employee_id',
        'position',
        'phone_number',
        'campaign',
        'supervisor',
        'observacion',
        'wave',
        'site'
    ];
    /**
     * Get the proveedores record associated with the user.
     */
    public function activo()
    {
        return $this->hasOne('App\InvAdquisicion', 'id', 'id_activo');
    }
}
