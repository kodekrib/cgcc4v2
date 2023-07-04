<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingsTable extends Migration
{
    public function up()
    {
        Schema::create('mailings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_mailing_list')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
