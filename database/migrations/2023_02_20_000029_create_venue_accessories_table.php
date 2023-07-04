<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueAccessoriesTable extends Migration
{
    public function up()
    {
        Schema::create('venue_accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accessories');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
