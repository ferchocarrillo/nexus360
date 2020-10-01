<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCgmAppointmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cgm_appointment_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->string('phone_number_combined')->nullable();
            $table->string('executive_first_name')->nullable();
            $table->string('executive_last_name')->nullable();
            $table->string('executive_title')->nullable();
            $table->string('professional_title')->nullable();
            $table->string('executive_gender')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('mailing_zip_code')->nullable();
            $table->string('mailing_zip_4')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->string('location_zip_code')->nullable();
            $table->string('location_zip_4')->nullable();
            $table->string('name_file_upload')->nullable();
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
        Schema::dropIfExists('cgm_appointment_lists');
    }
}
