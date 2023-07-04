<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstTimersTable extends Migration
{
    public function up()
    {
        Schema::create('first_timers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('service')->nullable();
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('occupation')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->longText('residential_address')->nullable();
            $table->string('nearest_bus_stop')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('join_cgcc')->nullable();
            $table->string('start_ats')->nullable();
            $table->string('ats_mode')->nullable();
            $table->longText('prayer_request')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
