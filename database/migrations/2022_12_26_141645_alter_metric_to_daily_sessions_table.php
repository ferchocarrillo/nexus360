<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterMetricToDailySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sessions', function (Blueprint $table) {
            DB::statement("ALTER TABLE daily_sessions ALTER COLUMN metric [nvarchar](30) NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_sessions', function (Blueprint $table) {
            DB::statement("ALTER TABLE daily_sessions ALTER COLUMN metric [nvarchar](20) NULL");
        });
    }
}
