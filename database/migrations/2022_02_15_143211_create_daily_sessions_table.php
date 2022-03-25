<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id');
            $table->string('national_id',30);
            $table->string('agent_name',100);
            $table->string('corporate_email',50)->nullable();
            $table->string('lob',20)->nullable();
            $table->string('campaign',50)->nullable();
            $table->string('team_leader',50);
            $table->string('type',30);
            $table->string('tactic',30);
            $table->string('behaviour',100);
            $table->string('metric',20)->nullable();
            $table->decimal('score')->nullable();
            $table->string('documented',20)->nullable();
            $table->string('root_cause',30)->nullable();
            $table->string('educational_tool',50)->nullable();
            $table->text('comments')->nullable();
            $table->boolean('acknowledge')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('daily_sessions');
    }
}
