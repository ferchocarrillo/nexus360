<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idCase');
            $table->foreign('idCase')->references('id')->on('kaizens');
            $table->string('type_request');
            $table->string('rules_test');
            $table->string('routes_test');
            $table->string('views_test');
            $table->string('databases_test');
            $table->string('migration_test');
            $table->string('seeder_test');
            $table->string('export_test');
            $table->string('adminlte_test');
            $table->string('permission_test');
            $table->string('additional_test');
            $table->string('view_count');
            $table->string('elapsed_created');
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
        Schema::dropIfExists('developers_tests');
    }
}
