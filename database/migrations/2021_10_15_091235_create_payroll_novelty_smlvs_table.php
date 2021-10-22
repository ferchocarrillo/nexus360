<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollNoveltySmlvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_novelty_smlvs', function (Blueprint $table) {
            $table->string('year',4);
            $table->integer('salary');
            $table->primary(['year']);
            // $table->decimal('daily_salary', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_novelty_smlvs');
    }
}
