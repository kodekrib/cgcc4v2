<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIssueManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('issue_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('issue_location_id')->nullable();
            $table->foreign('issue_location_id', 'issue_location_fk_7824137')->references('id')->on('asset_locations');
            $table->unsignedBigInteger('department_concerned_id')->nullable();
            $table->foreign('department_concerned_id', 'department_concerned_fk_7812478')->references('id')->on('departments');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7812483')->references('id')->on('users');
        });
    }
}
