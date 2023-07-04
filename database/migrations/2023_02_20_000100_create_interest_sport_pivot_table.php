<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestSportPivotTable extends Migration
{
    public function up()
    {
        Schema::create('interest_sport', function (Blueprint $table) {
            $table->unsignedBigInteger('interest_id');
            $table->foreign('interest_id', 'interest_id_fk_7635923')->references('id')->on('interests')->onDelete('cascade');
            $table->unsignedBigInteger('sport_id');
            $table->foreign('sport_id', 'sport_id_fk_7635923')->references('id')->on('sports')->onDelete('cascade');
        });
    }
}
