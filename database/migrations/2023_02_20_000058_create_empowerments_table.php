<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpowermentsTable extends Migration
{
    public function up()
    {
        Schema::create('empowerments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cooperative');
            $table->decimal('contribution_amount', 15, 2)->nullable();
            $table->string('contribution_frequency')->nullable();
            $table->integer('start_year')->nullable();
            $table->string('start_month')->nullable();
            $table->string('business_advisory');
            $table->string('advisory_team')->nullable();
            $table->string('trainings')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
