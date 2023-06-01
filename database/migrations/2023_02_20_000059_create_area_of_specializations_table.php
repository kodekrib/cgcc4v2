<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaOfSpecializationsTable extends Migration
{
    public function up()
    {
        Schema::create('area_of_specializations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area_of_specialization')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
