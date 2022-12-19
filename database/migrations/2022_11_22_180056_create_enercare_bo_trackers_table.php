<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareBoTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_bo_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lob', 20)->nullable();
            $table->string('queue_tracker', 30);
            $table->string('case', 20)->unique();
            $table->dateTime('case_actioned');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('call_centre', 30);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enercare_bo_trackers');
    }
}
