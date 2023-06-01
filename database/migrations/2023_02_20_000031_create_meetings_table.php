<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_of_meeting')->nullable();
            $table->string('time_duration')->nullable();
            $table->string('meeting_title');
            //$table->boolean('processing')->default(0)->nullable();
            //$table->boolean('approved')->default(0)->nullable();
            //$table->boolean('disapproved')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
