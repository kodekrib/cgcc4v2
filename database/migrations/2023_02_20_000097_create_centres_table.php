<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentresTable extends Migration
{
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('cih_centre')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
