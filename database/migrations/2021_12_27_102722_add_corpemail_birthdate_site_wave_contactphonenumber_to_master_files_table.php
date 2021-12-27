<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorpemailBirthdateSiteWaveContactphonenumberToMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_files', function (Blueprint $table) {
            $table->string('wave',50)->nullable();
            $table->string('site',50)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('corp_email',50)->nullable();
            $table->string('contact_phone_number',50)->nullable();
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
            $table->dropColumn('wave');
            $table->dropColumn('site');
            $table->dropColumn('birth_date');
            $table->dropColumn('corp_email');
            $table->dropColumn('contact_phone_number');
        });
    }
}
