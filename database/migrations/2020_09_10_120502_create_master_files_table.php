<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_document',10);
            $table->string('national_id',30);
            $table->string('full_name',100);
            $table->string('campaign',100);
            $table->string('position',150);
            $table->string('supervisor',100);
            $table->string('payroll_manager',100)->nullable();
            $table->date('joining_date');
            $table->date('joining_date_campaign');
            $table->date('termination_date')->nullable();
            $table->string('status',30);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_files');
    }
}
