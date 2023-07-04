<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChristeningsTable extends Migration
{
    public function up()
    {
        Schema::table('christenings', function (Blueprint $table) {
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id', 'zone_fk_8035790')->references('id')->on('cihzones');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8035797')->references('id')->on('users');
        });
    }
}
