<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvAdquisicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_adquisicions', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('tipo_entrada');
            $table->date('created_at');
            $table->string('bodega');
            $table->bigInteger('id_proveedor');
            $table->string('num_factura')->nullable();
            $table->string('estado');
            $table->string('tipo_requerimiento')->nullable();
            $table->string('grupo');
            $table->string('atributos');
            $table->string('codigo')->nullable();
            $table->string('descripcion');
            $table->integer('costo_unitario')->nullable();
            $table->boolean('anulado');
            $table->integer('numero_requerimiento')->nullable();
            $table->unsignedBigInteger('id_asignacion')->nullable();
            $table->foreign('id_asignacion')->references('id')->on('inv_asignacions')->delete('cascade');
            $table->boolean('baja');
            $table->date('Updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_adquisicions');
    }
}
