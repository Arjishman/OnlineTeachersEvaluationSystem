<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacherinfos', function (Blueprint $table) {
            $table->string('tid',20)->primary();
            $table->string('tname',50)->nullable();
            $table->string('deptcode',10)->nullable();
            $table->string('password')->default('123');
            $table->boolean('tactivestatus')->default(0);
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
        Schema::dropIfExists('teacherinfos');
    }
}
