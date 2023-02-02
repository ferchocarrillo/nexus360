<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareTrackerSupportFacilitatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_tracker_support_facilitators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agent', 50);
            $table->string('process', 30);
            $table->string('process_specific', 100);
            $table->string('additional_details', 70)->nullable();
            $table->string('behavior_identified', 15)->nullable();
            $table->string('recomendations', 50)->nullable();
            $table->tinyInteger('repeated_interaction',false,false);
            $table->string('observations',180);
            $table->boolean('conference_in')->nullable();
            $table->boolean('supervisor_assistence')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('enercare_tracker_support_facilitators');
    }
}
