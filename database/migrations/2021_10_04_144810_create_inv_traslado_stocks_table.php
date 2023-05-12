<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvTrasladoStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_traslado_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fTraslado');
            $table->bigInteger('user_id');
            $table->string('ultimoAsignado');
            $table->string('cargoultimoAsignado');
            $table->bigInteger('telefono');
            $table->string('wave');
            $table->string('bodegaActual');
            $table->string('bodegaDestino');
            $table->integer('cantidad');
            $table->integer('cantidadStock');
            $table->longText('observacion');
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
        Schema::dropIfExists('inv_traslado_stocks');
    }
}
