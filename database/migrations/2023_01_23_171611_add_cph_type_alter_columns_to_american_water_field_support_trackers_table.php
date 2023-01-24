<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCphTypeAlterColumnsToAmericanWaterFieldSupportTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('american_water_field_support_trackers', function (Blueprint $table) {
            $table->string('cph', 10)->nullable();
            $table->string('type', 10)->nullable();
            DB::statement("ALTER TABLE american_water_field_support_trackers ALTER COLUMN [threshold] [nvarchar](15) NULL");
            DB::statement("ALTER TABLE american_water_field_support_trackers ALTER COLUMN [status] [nvarchar](30) NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('american_water_field_support_trackers', function (Blueprint $table) {
            $table->dropColumn('cph');
            $table->dropColumn('type');
            DB::statement("ALTER TABLE american_water_field_support_trackers ALTER COLUMN [threshold] [nvarchar](15) NOT NULL");
            DB::statement("ALTER TABLE american_water_field_support_trackers ALTER COLUMN [status] [nvarchar](30) NOT NULL");
        });
    }
}
