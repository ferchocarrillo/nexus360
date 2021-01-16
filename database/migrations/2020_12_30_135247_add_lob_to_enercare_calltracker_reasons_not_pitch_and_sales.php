<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLobToEnercareCalltrackerReasonsNotPitchAndSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enercare_calltracker_reasons_not_pitch_and_sales', function (Blueprint $table) {
            $table->string('lob',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enercare_calltracker_reasons_not_pitch_and_sales', function (Blueprint $table) {
            $table->dropColumn('lob');
        });
    }
}
