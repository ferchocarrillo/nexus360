<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriviaQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trivia_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trivia_id')->index();
            $table->foreign('trivia_id')->references('id')->on('trivias');
            $table->string('question',150);
            $table->boolean('is_enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trivia_questions');
    }
}
