<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutreachesTable extends Migration
{
    public function up()
    {
        Schema::create('outreaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('completed')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
