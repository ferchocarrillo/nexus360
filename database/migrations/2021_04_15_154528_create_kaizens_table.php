<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaizens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50);
            $table->string('group',25);
            $table->string('campaign',50);
            $table->string('type',25);
            $table->text('schedules')->nullable();
            $table->text('file_path')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('required_by');
            $table->foreign('required_by')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->string('status',25)->nullable();
            $table->date('deadline')->nullable();
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
        Schema::dropIfExists('kaizens');
    }
}
