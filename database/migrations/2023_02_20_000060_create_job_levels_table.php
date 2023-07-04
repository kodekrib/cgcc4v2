<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('job_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
