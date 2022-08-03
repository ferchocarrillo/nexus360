<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollAdjustmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->create('payroll_adjustment_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_type', 50);
            $table->string('adjustment_type', 50);
            $table->boolean('approve_by_om')->nullable();
            $table->string('justification', 100);
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
        Schema::connection('sqlsrvpayroll')->dropIfExists('payroll_adjustment_types');
    }
}
