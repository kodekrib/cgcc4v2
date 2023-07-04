<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMailingsTable extends Migration
{
    public function up()
    {
        Schema::table('mailings', function (Blueprint $table) {
            $table->unsignedBigInteger('area_of_specialization_id')->nullable();
            $table->foreign('area_of_specialization_id', 'area_of_specialization_fk_7831445')->references('id')->on('area_of_specializations');
            $table->unsignedBigInteger('job_level_id')->nullable();
            $table->foreign('job_level_id', 'job_level_fk_7831446')->references('id')->on('job_levels');
        });
    }
}
