<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationresults', function (Blueprint $table) {
            $table->id();
            $table->string('courseid',10);
            $table->string('year','6');
            $table->string('semester',8);
            $table->string('tid',20);
            $table->integer('positive_response');
            $table->integer('mean_score');
            $table->integer('total_weight');
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
        Schema::dropIfExists('evaluationresults');
    }
}
