<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihmembersTable extends Migration
{
    public function up()
    {
        Schema::create('cihmembers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
