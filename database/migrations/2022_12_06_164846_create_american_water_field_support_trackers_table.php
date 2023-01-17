<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmericanWaterFieldSupportTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('american_water_field_support_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cph', 10);
            $table->string('claim_number', 10);
            $table->string('threshold', 15)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('type', 10)->nullable();
            $table->string('observations', 150)->nullable();
            $table->dateTime('case_actioned');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->unsignedBigInteger('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('american_water_field_support_trackers');
    }
}
