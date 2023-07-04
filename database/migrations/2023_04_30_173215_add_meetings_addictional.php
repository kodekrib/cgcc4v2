<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeetingsAddictional extends Migration
{

    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->json('addictional_json')-> nullable();
        });
    }


    public function down()
    {
        //
    }
}
