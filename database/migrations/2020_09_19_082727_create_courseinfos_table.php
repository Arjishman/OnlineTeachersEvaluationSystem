<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseinfos', function (Blueprint $table) {
            $table->id();
            $table->string('courseid',10)->unique();
            $table->string('year',6)->nullable();
            $table->string('semester',6)->nullable();
            $table->string('part',3)->nullable();
            $table->string('teacherinfo_id');
            $table->string('deptcode',10)->nullable();
            $table->boolean('openforevaluation')->default(0);
            $table->string('qsetmcq',150)->nullable();
            $table->string('qsetopen',150)->nullable();
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
        Schema::dropIfExists('courseinfos');
    }
}
