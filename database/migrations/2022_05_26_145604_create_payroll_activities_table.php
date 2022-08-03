<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->create('payroll_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',35)->unique();
            $table->unsignedBigInteger('payroll_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->string('activity_type',50);
            $table->string('activity_name',50);
            $table->string('surcharge',30)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('total_time_in_seconds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrvpayroll')->dropIfExists('payroll_activities');
    }
}
