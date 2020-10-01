<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCgmAppointmentDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cgm_appointment_dispositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('required_appointment');
            $table->boolean('required_date');
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
        Schema::dropIfExists('cgm_appointment_dispositions');
    }
}
