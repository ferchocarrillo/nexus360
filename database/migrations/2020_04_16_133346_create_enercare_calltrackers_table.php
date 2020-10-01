<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnercareCalltrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enercare_calltrackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('site_id');
            $table->string('username',50);
            $table->string('category');
            $table->string('subcategory');
            $table->string('reason_not_pitch')->nullable();
            $table->string('reason_not_sale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enercare_calltrackers');
    }
}
