<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_name');
            $table->string('middlename')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email');
            $table->date('date_of_birth');
            $table->integer('age')->nullable();
            $table->string('gender');
            $table->string('marital_status');
            $table->boolean('born_in_nigeria')->default(0)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('nearest_bus_stop');
            $table->string('affinity_group')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
