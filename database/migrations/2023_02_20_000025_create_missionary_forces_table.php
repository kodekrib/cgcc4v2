<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionaryForcesTable extends Migration
{
    public function up()
    {
        Schema::create('missionary_forces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('missionary_force')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
