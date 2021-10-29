<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmericanWaterBoTrackerListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('american_water_bo_tracker_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->text('list');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('american_water_bo_tracker_lists');
    }
}
