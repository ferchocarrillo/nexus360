<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvArticulosAtributos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('inv_articulos_inv_atributos', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('articulo_id');
        //     $table->foreign('articulo_id')->references('id')->on('inv_articulos')->onDelete('cascade') ;
        //     $table->unsignedBigInteger('atributo_id');
        //     $table->foreign('atributo_id')->references('id')->on('inv_atributos');
        // });

        Schema::create('inv_articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('articulo');
            $table->string('codigo');
            $table->timestamps();
        });

        Schema::create('inv_articulo_atributo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('articulo_id')->nullable();
            $table->foreign('articulo_id')->references('id')->on('inv_articulos')->onDelete('cascade');
            $table->unsignedBigInteger('atributo_id')->nullable();
            $table->foreign('atributo_id')->references('id')->on('inv_atributos')->onDelete('cascade');
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
        Schema::dropIfExists('inv_articulos');
        Schema::dropIfExists('inv_articulo_atributo');

    }
}
