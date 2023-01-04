<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateModuurnCalltrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduurn_calltrackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('phone_number1');
            $table->bigInteger('phone_number2')->nullable();
            $table->string('list_id', 20);
            $table->string('not_show', 3);
            $table->string('is_schedule', 20)->nullable();
            $table->string('reason_not_schedule', 55)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('transferCall', 3)->nullable();
            $table->dateTime('date_schedule')->nullable();
            $table->string('region', 35);
            $table->string('country', 35);
            $table->string('state', 35);
            $table->string('expert', 50);
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->unsignedBigInteger('created_by');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moduurn_calltrackers');
    }
}
