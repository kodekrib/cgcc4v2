<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReminder extends Migration
{

    public function up()
    {
        Schema::table('reminders', function (Blueprint $table) {

            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id', 'member_fk_80357898770')->references('id')->on('members');
        });
    }


}
