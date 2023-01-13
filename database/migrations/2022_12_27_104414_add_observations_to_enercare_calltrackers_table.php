<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservationsToEnercareCalltrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enercare_calltrackers', function (Blueprint $table) {
            $table->string('observations',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enercare_calltrackers', function (Blueprint $table) {
            $table->dropColumn('observations');
        });
    }
}
