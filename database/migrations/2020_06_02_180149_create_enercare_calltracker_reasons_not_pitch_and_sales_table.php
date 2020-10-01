<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareCalltrackerReasonsNotPitchAndSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_calltracker_reasons_not_pitch_and_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type',20);
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enercare_calltracker_reasons_not_pitch_and_sales');
    }
}
