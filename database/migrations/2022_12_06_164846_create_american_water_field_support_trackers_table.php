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
            $table->string('claim_number', 10);
            $table->string('threshold', 8);
            $table->string('status', 8);
            $table->string('observations', 255)->nullable();
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
