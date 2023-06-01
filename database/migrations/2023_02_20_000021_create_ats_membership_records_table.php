<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtsMembershipRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('ats_membership_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ats_membership_no')->nullable();
            $table->string('names')->nullable();
            $table->string('classes')->nullable();
            $table->string('batch')->nullable();
            $table->integer('year')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
