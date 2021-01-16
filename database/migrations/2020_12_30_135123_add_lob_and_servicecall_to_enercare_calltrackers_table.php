<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLobAndServicecallToEnercareCalltrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enercare_calltrackers', function (Blueprint $table) {
            $table->string('lob',50)->nullable();
            $table->boolean('service_call')->nullable();
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
            $table->dropColumn(['lob','service_call']);
        });
    }
}
