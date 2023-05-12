<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nit')->unique();
            $table->string('nombreEmpresa');
            $table->bigInteger('telEmpresa');
            $table->string('nombreAsesor');
            $table->string('correo');
            $table->string('direccion');
            $table->text('descripcion');
            $table->string('sitoWeb');
            $table->string('segmento');
            $table->string('estado');
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
        Schema::dropIfExists('inv_proveedores');
    }
}
