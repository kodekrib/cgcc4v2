<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('goal_name')->nullable();
            $table->longText('note')->nullable();
            $table->date('achievement_date')->nullable();
            $table->string('goal_kpi')->nullable();
            $table->boolean('open')->default(0)->nullable();
            $table->boolean('in_progress')->default(0)->nullable();
            $table->boolean('not_archieved')->default(0)->nullable();
            $table->boolean('closed')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
