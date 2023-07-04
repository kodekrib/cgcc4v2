<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihzonesTable extends Migration
{
    public function up()
    {
        Schema::create('cihzones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('zone')->unique();
            $table->string('zone_area')->unique();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('inactive')->default(0)->nullable();
            $table->boolean('cancelled')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
