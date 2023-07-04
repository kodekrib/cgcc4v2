<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAffinityGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('affinity_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('head_of_group_id')->nullable();
            $table->foreign('head_of_group_id', 'head_of_group_fk_7635068')->references('id')->on('users');
        });
    }
}
