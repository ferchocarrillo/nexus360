<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBogoAndRepairplanToEnercareCalltrackerPitchAndSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enercare_calltracker_pitch_and_sales', function (Blueprint $table) {
            $table->boolean('bogo')->nullable();
            $table->boolean('repairplan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enercare_calltracker_pitch_and_sales', function (Blueprint $table) {
            $table->dropColumn(['bogo','repairplan']);
        });
    }
}
