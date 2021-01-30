<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentcourseregistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentcourseregistrations', function (Blueprint $table) {
            $table->id();
            $table->string('courseid',10);
            $table->string('sid',20);
            $table->boolean('evaluationstatus')->default(0);
            $table->timestamps();

            $table->foreign('courseid')->references('courseid')->on('courseinfos');
            $table->foreign('sid')->references('sid')->on('studentinfos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentcourseregistrations');
    }
}
