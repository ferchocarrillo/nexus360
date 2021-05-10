<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaizenCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaizen_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kaizen_id');
            $table->foreign('kaizen_id')->references('id')->on('kaizens')->onDelete('cascade');
            $table->text('file_path')->nullable();
            $table->string('status',25);
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
        Schema::dropIfExists('kaizen_comments');
    }
}
