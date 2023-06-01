<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMountainOfInfluencesTable extends Migration
{
    public function up()
    {
        Schema::table('mountain_of_influences', function (Blueprint $table) {
            $table->unsignedBigInteger('my_mountain_of_culture_id')->nullable();
            $table->foreign('my_mountain_of_culture_id', 'my_mountain_of_culture_fk_7952044')->references('id')->on('mountains_of_influences');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7952048')->references('id')->on('members');
        });
    }
}
