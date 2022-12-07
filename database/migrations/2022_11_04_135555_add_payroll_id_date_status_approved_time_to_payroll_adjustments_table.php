<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayrollIdDateStatusApprovedTimeToPayrollAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->table('payroll_adjustments', function (Blueprint $table) {
            $table->unsignedBigInteger('payroll_id')->nullable();
            $table->date('date')->nullable();
            $table->string('status',30)->nullable();
            $table->integer('approved_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrvpayroll')->table('payroll_adjustments', function (Blueprint $table) {
            $table->dropColumn('payroll_id');
            $table->dropColumn('date');
            $table->dropColumn('status');
            $table->dropColumn('approved_time');
        });
    }
}
