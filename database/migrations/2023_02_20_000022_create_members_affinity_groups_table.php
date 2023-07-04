<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersAffinityGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('members_affinity_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_name')->nullable();
            $table->string('affinity_group')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
