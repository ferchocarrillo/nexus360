<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceexpertsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceexperts_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('path',255);
            $table->string('directory',255);
            $table->boolean('folder')->default(0) ;
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
        Schema::dropIfExists('serviceexperts_files');
    }
}
