<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('other_sports')->nullable();
            $table->string('social_causes')->nullable();
            $table->string('entrepreneurial_interests')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
