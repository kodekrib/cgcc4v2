<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMembersTable extends Migration
{
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('title_id')->nullable();
            $table->foreign('title_id', 'title_fk_7612185')->references('id')->on('titles');
            $table->unsignedBigInteger('employment_status_id')->nullable();
            $table->foreign('employment_status_id', 'employment_status_fk_7612204')->references('id')->on('employment_statuses');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7612295')->references('id')->on('members');
        });
    }
}
