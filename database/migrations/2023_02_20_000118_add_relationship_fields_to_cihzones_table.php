<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCihzonesTable extends Migration
{
    public function up()
    {
        Schema::table('cihzones', function (Blueprint $table) {
            $table->unsignedBigInteger('coordinator_id')->nullable();
            $table->foreign('coordinator_id', 'coordinator_fk_7634629')->references('id')->on('members');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7974142')->references('id')->on('users');
        });
    }
}
