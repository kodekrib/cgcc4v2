<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMissionaryForcesTable extends Migration
{
    public function up()
    {
        Schema::table('missionary_forces', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7635895')->references('id')->on('users');
        });
    }
}
