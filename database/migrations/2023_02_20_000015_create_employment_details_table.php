<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employer_name');
            $table->string('employer_address')->nullable();
            $table->string('employer_address_2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('position_held')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
