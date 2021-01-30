<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperadmininfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superadmininfos', function (Blueprint $table) {
            $table->string('suadmin',20)->primary();
            $table->string('supw');
            $table->timestamps();
        });

        \App\Superadmininfo::create([
            'suadmin' => 'superAdmin001',
            'supw' =>\Illuminate\Support\Facades\Hash::make('admin')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmininfos');
    }
}
