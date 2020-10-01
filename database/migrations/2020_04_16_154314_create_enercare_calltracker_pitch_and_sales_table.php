<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareCalltrackerPitchAndSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_calltracker_pitch_and_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('call_id');
            $table->foreign('call_id')->references('id')->on('enercare_calltrackers')->onDelete('cascade');
            $table->string('type',10);
            $table->string('plan',100);
            $table->string('contract_id',20)->nullable();
            $table->boolean('upgrade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enercare_calltracker_pitch_and_sales');
    }
}
