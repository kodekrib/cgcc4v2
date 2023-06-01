<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTypeOfAppoinmentsTable extends Migration
{
    public function up()
    {
        Schema::table('type_of_appoinments', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7951124')->references('id')->on('users');
        });
    }
}
