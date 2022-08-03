<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrvpayroll')->create('payrolls', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->integer('employee_id');
            $table->string('national_id',30);
            $table->date('date');
            $table->tinyInteger('day');
            $table->tinyInteger('day_of_week');
            $table->boolean('is_holiday')->nullable();
            $table->string('schedule',1000)->nullable();
            $table->string('novelty',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrvpayroll')->dropIfExists('payrolls');
    }
}
