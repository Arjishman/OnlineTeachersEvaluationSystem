<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionopenendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionopenendeds', function (Blueprint $table) {
            $table->id();
            $table->string('qset',150);
            $table->string('categoryid',50);
            $table->string('categorydesc',250);
            $table->string('qdesopenended',256);
            $table->string('deptcode',15);
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
        Schema::dropIfExists('questionopenendeds');
    }
}
