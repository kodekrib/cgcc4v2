<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffinityGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('affinity_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('affinity_group');
            $table->string('affinity_group_code');
            $table->string('criteria');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
