<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriviaAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trivia_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trivia_id')->index();
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->boolean('is_correct');
            $table->integer('seconds');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('trivia_answers');
    }
}
