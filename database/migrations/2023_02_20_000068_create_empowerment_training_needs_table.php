<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpowermentTrainingNeedsTable extends Migration
{
    public function up()
    {
        Schema::create('empowerment_training_needs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('training_needs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
