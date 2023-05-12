<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvActivoFijoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_activo_fijo', function (Blueprint $table) {

            $table->string('tipo_entrada');
            $table->string('bodega');
            $table->string('estado');
            $table->string('tipo_requerimiento')->nullable();
            $table->bigInteger('id_proveedor');
            $table->string('grupo');
            $table->string('especificaciones');
            $table->string('n_factura')->nullable();
            $table->string('descripcion');
            $table->integer('costo_unitario');
            $table->bigInteger('cantidad');
            $table->integer('numero_requerimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_activo_fijo');
    }
}
