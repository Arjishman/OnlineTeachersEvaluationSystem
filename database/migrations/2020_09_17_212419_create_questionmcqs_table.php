<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionmcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionmcqs', function (Blueprint $table) {
            $table->id();
            $table->string('qset',150);
            $table->string('categoryid',50);
            $table->string('categorydesc',250);
            $table->string('qdescription',256);
            $table->string('qopdes1',50);
            $table->string('qopdes2',50);
            $table->string('qopdes3',50);
            $table->string('qopdes4',50);
            $table->string('qopdes5',50);
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
        Schema::dropIfExists('questionmcqs');
    }
}
