<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddViewAlterSpreadsheetToAmericanWaterBoTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('american_water_bo_trackers', function (Blueprint $table) {
            DB::statement("ALTER TABLE american_water_bo_trackers ALTER COLUMN [spreadsheet] [nvarchar](50) NULL");
            $table->string('view',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('american_water_bo_trackers', function (Blueprint $table) {
            DB::statement("ALTER TABLE american_water_bo_trackers ALTER COLUMN [spreadsheet] [nvarchar](10) NULL");
            $table->dropColumn('view');
        });
    }
}
