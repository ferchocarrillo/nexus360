<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->create('payroll_adjustments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_code',35);
            $table->unsignedBigInteger('employee_id');
            $table->string('adjustment_type',50);
            $table->string('justification',50);
            $table->string('observations',255);
            $table->boolean('supervisor_approval_required');
            $table->string('supervisor_approval_status',30)->nullable();
            $table->dateTime('supervisor_approval_date')->nullable();
            $table->unsignedBigInteger('supervisor_approval_user_id')->nullable();
            $table->string('supervisor_approval_comment',255)->nullable();
            $table->boolean('om_approval_required');
            $table->string('om_approval_status',30)->nullable();
            $table->dateTime('om_approval_date')->nullable();
            $table->unsignedBigInteger('om_approval_user_id')->nullable();
            $table->string('om_approval_comment',255)->nullable();
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
        Schema::connection('sqlsrvpayroll')->dropIfExists('payroll_adjustments');
    }
}
