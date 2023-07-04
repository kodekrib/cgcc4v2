<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('attendance_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->longText('summary_report')->nullable();
            $table->string('age_category')->nullable();
            $table->string('gender_category')->nullable();
            $table->string('state_of_the_flock')->nullable();
            $table->boolean('present')->default(0)->nullable();
            $table->boolean('absent')->default(0)->nullable();
            $table->boolean('excused')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
