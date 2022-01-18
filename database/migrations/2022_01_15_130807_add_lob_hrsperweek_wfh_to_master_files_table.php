<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLobHrsperweekWfhToMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_files', function (Blueprint $table) {
            $table->string('lob',50)->nullable();
            $table->float('hrs_per_week')->nullable();
            $table->boolean('wfh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_files', function (Blueprint $table) {
            $table->dropColumn('lob');
            $table->dropColumn('hrs_per_week');
            $table->dropColumn('wfh');
        });
    }
}
