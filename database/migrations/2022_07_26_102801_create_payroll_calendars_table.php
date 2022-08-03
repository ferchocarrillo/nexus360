<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->create('payroll_calendars', function (Blueprint $table) {
            $table->date('date')->unique()->primary();
            $table->integer('day');
            $table->string('day_name',60);
            $table->integer('week');
            $table->integer('iso_week');
            $table->integer('day_of_week');
            $table->integer('q');
            $table->integer('month');
            $table->string('month_name',60);
            $table->date('first_of_month');
            $table->date('last_of_month');
            $table->integer('year');
            $table->integer('day_of_year');
            $table->boolean('holiday')->nullable();
            $table->string('holiday_description',100)->nullable();
            $table->boolean('closed')->nullable();
            $table->boolean('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrvpayroll')->dropIfExists('payroll_calendars');
    }
}
