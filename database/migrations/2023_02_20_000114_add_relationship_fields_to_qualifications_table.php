<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQualificationsTable extends Migration
{
    public function up()
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->unsignedBigInteger('highest_qualifications_id')->nullable();
            $table->foreign('highest_qualifications_id', 'highest_qualifications_fk_7612247')->references('id')->on('qualification_settings');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7612302')->references('id')->on('users');
        });
    }
}
