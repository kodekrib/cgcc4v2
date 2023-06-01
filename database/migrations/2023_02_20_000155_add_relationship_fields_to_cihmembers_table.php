<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCihmembersTable extends Migration
{
    public function up()
    {
        Schema::table('cihmembers', function (Blueprint $table) {
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id', 'zone_fk_7976806')->references('id')->on('cihzones');
            $table->unsignedBigInteger('cih_id')->nullable();
            $table->foreign('cih_id', 'cih_fk_8035397')->references('id')->on('centres');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7976811')->references('id')->on('users');
        });
    }
}
