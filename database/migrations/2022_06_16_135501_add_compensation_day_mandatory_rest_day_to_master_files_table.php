<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompensationDayMandatoryRestDayToMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_files', function (Blueprint $table) {
            $table->integer('compensation_day')->nullable();
            $table->integer('mandatory_rest_day')->nullable();
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
            $table->dropColumn('compensation_day');
            $table->dropColumn('mandatory_rest_day');
        });
    }
}
