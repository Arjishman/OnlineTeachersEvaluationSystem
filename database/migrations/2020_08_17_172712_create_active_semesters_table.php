<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_semesters', function (Blueprint $table) {
            $table->id();
            $table->string('semester',10)->nullable();
            $table->string('year',10)->nullable();
            $table->string('dept',10)->nullable();
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });

        /*\App\ActiveSemester::create([
            'semester' => 'spring',
            'dept' => 'cse',
            'year' => '2020'
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_semesters');
    }
}
