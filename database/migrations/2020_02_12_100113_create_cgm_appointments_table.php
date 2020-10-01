<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCgmAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cgm_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('callID');
            $table->string('executive_first_name')->nullable();
            $table->string('executive_last_name')->nullable();
            $table->string('executive_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->string('location_zip_code')->nullable();
            $table->string('phone_number_combined')->nullable();
            $table->string('disposition');
            $table->string('speciality_of_the_practice')->nullable();
            $table->string('solutions_currently_being_used')->nullable();
            $table->string('current_contract_term')->nullable();
            $table->string('customer_budget')->nullable();
            $table->string('percent_of_claims_paid')->nullable();
            $table->string('current_solution_positives')->nullable();
            $table->string('current_solution_challenges')->nullable();
            $table->string('additional_participants')->nullable();
            $table->string('cgm_solutions_of_interest')->nullable();
            $table->string('confirmed_email')->nullable();
            $table->dateTime('appointment_date')->nullable();
            $table->boolean('lunch_and_learn')->nullable();
            $table->text('comments');
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
        Schema::dropIfExists('cgm_appointments');
    }
}
