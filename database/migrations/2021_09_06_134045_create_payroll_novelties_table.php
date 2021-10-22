<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollNoveltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_novelties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('national_id',30);
            $table->string('pep',50)->nullable();
            $table->string('full_name',100);
            $table->date('date_of_hire');
            $table->string('campaign',50);
            $table->string('eps',50);
            $table->string('supervisor',100);
            $table->decimal('basic_salary_cop', 10, 2);
            $table->string('tag',50);
            $table->string('contingency',20);
            $table->string('cie10','10')->nullable();
            $table->string('cie10_description','255')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('days_hours',8,2);
            $table->boolean('extension')->nullable();
            $table->integer('extension_id')->nullable();
            $table->string('status',50);
            $table->date('payroll_date')->nullable();
            $table->integer('days_to_recover')->nullable();
            $table->date('date_of_filing')->nullable();
            $table->decimal('recognized_value', 10, 2)->nullable();
            $table->date('date_of_deposit')->nullable();
            $table->string('observation',255)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('payroll_novelties');
    }
}
