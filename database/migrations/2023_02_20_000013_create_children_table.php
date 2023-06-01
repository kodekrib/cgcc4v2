<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position_in_family')->nullable();
            $table->string('full_names')->unique();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('relationship');
            $table->string('specify')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
