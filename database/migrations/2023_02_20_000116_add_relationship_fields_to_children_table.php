<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChildrenTable extends Migration
{
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->unsignedBigInteger('father_name_id')->nullable();
            $table->foreign('father_name_id', 'father_name_fk_8013919')->references('id')->on('members');
            $table->unsignedBigInteger('mothers_name_id')->nullable();
            $table->foreign('mothers_name_id', 'mothers_name_fk_8013947')->references('id')->on('members');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7612389')->references('id')->on('members');
        });
    }
}
