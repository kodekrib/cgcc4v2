<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('hod_id')->nullable();
            $table->foreign('hod_id', 'hod_fk_7634814')->references('id')->on('members');
            $table->unsignedBigInteger('organization_type_id')->nullable();
            $table->foreign('organization_type_id', 'organization_type_fk_7634815')->references('id')->on('organization_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7977444')->references('id')->on('users');
        });
    }
}
