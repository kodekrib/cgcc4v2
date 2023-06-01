<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCentresTable extends Migration
{
    public function up()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->unsignedBigInteger('name_id')->nullable();
            $table->foreign('name_id', 'name_fk_8035820')->references('id')->on('members');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_8035822')->references('id')->on('roles');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8035826')->references('id')->on('users');
        });
    }
}
