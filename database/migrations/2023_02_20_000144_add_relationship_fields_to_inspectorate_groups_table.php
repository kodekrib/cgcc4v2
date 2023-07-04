<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInspectorateGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('inspectorate_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_7830210')->references('id')->on('roles');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8036024')->references('id')->on('users');
        });
    }
}
