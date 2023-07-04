<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTypesTable extends Migration
{
    public function up()
    {
        Schema::create('meeting_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('types')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
