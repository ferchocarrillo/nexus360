<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_asignacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->date('fAsignacion');
            $table->bigInteger('user_id');
            $table->string('nombreAsignado');
            $table->string('cargo');
            $table->bigInteger('telefono');
            $table->string('campaña');
            $table->string('bodega');
            $table->integer('cantidad');
            $table->longText('observacion');
            $table->string('factura');
            $table->integer('precios');
            $table->string('terminos');
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
        Schema::dropIfExists('inv_asignacions');
    }
}
