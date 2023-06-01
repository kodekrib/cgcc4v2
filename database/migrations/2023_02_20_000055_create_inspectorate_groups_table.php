<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectorateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('inspectorate_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
