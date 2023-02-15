<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDearServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dear_services_tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('custumer_name', 60);
            $table->bigInteger('phone_number');
            $table->string('disposition', 60);
            $table->integer('call_attempts');
            $table->longText('comments');
            $table->string('created_by');
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
        Schema::dropIfExists('dear_services');
    }
}
