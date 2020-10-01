<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCgmQaRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cgm_qa_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('cgm_appointments');
            $table->unsignedBigInteger('qa_id');
            $table->foreign('qa_id')->references('id')->on('users');
            $table->boolean('details_confirmed_via_call');
            $table->boolean('voice_recording_sent');
            $table->boolean('accepted_calendar_invite');
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
        Schema::dropIfExists('cgm_qa_ratings');
    }
}
