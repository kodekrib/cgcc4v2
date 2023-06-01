<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInterestsTable extends Migration
{
    public function up()
    {
        Schema::table('interests', function (Blueprint $table) {
            $table->unsignedBigInteger('industry_sector_id')->nullable();
            $table->foreign('industry_sector_id', 'industry_sector_fk_7635927')->references('id')->on('industry_sectors');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7635931')->references('id')->on('users');
        });
    }
}
