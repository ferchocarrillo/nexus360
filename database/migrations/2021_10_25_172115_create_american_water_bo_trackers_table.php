<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmericanWaterBoTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('american_water_bo_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',50);
            $table->foreign('username')->references('username')->on('users');
            $table->string('queue',50);
            $table->string('cus_id',50)->nullable();
            $table->string('customer_name',50)->nullable();
            $table->string('spreadsheet',10)->nullable();
            $table->string('status',50)->nullable();
            $table->string('enr_number',200)->nullable();
            $table->string('agreement_classification',50)->nullable();
            $table->text('additional_notes')->nullable();
            $table->dateTime('started_at');
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
        Schema::dropIfExists('american_water_bo_trackers');
    }
}
