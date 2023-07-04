<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDedicationsTable extends Migration
{
    public function up()
    {
        Schema::create('dedications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent')->nullable();
            $table->integer('no_at_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_dedication')->nullable();
            $table->string('department')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->boolean('pending')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
