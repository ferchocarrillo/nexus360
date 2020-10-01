<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareCalltrackerPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_calltracker_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('valid_sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enercare_calltracker_plans');
    }
}
