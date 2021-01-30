<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluatemcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluatemcqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cregid');
            $table->unsignedBigInteger('qidmcq');
            $table->integer('response');
            $table->timestamps();

            $table->foreign('cregid')->references('id')->on('studentcourseregistrations');
            $table->foreign('qidmcq')->references('id')->on('questionmcqs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluatemcqs');
    }
}
