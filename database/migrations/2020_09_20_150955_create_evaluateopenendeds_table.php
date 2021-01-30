<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluateopenendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluateopenendeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cregid');
            $table->unsignedBigInteger('qidopenended');
            $table->string('answerdesc',512);
            $table->timestamps();

            $table->foreign('cregid')->references('id')->on('studentcourseregistrations');
            $table->foreign('qidopenended')->references('id')->on('questionopenendeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluateopenendeds');
    }
}
