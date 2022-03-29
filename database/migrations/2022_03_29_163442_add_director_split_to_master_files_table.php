<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDirectorSplitToMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_files', function (Blueprint $table) {
            $table->string('director',100)->nullable();
            $table->string('split',100)->nullable();
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
            $table->dropColumn('director');
            $table->dropColumn('split');
        });
    }
}
