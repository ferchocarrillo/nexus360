<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvEspecificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_especificacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_atributo');
            $table->foreign('id_atributo')
            ->references('id')
            ->on('inv_atributo')
            ->onDelete('cascade');
            $table->string('especificacion');
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
        Schema::dropIfExists('inv_especificacions');
    }
}
