<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvBajaStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_baja_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->string('articulo');
            $table->unsignedBigInteger('id_asignacion')->nullable();
            $table->foreign('inv_baja_stocks.id_asignacion')->references('id')->on('inv_asignacions')->delete('cascade');
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
        Schema::dropIfExists('inv_baja_stocks');
    }
}
