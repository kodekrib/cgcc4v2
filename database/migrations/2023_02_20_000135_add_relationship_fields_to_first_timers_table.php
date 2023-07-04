<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFirstTimersTable extends Migration
{
    public function up()
    {
        Schema::table('first_timers', function (Blueprint $table) {
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->foreign('marital_status_id', 'marital_status_fk_8036067')->references('id')->on('marital_statuses');
        });
    }
}
