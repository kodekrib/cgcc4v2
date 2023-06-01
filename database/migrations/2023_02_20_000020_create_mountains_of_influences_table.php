<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMountainsOfInfluencesTable extends Migration
{
    public function up()
    {
        Schema::create('mountains_of_influences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nation');
            $table->string('corresponding_mountain');
            $table->string('prevailing_culture');
            $table->string('counter_culture');
            $table->string('counter_culture_text');
            $table->string('attributes_of_christ');
            $table->string('motivational_gifts');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
