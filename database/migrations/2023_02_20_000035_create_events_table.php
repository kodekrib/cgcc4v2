<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->integer('expected_amount')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->integer('accredited')->nullable();
            $table->string('allow_overflow')->nullable();
            // $table->boolean('active')->default(0)->nullable();
            // $table->boolean('inactive')->default(0)->nullable();
            // $table->boolean('cancelled')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
