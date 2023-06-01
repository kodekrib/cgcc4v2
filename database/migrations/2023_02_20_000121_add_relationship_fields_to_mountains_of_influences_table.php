<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMountainsOfInfluencesTable extends Migration
{
    public function up()
    {
        Schema::table('mountains_of_influences', function (Blueprint $table) {
            $table->unsignedBigInteger('mountain_leader_id')->nullable();
            $table->foreign('mountain_leader_id', 'mountain_leader_fk_7635128')->references('id')->on('users');
        });
    }
}
