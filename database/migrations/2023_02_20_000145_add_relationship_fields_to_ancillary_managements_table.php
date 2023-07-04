<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAncillaryManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('ancillary_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('service_type_id')->nullable();
            $table->foreign('service_type_id', 'service_type_fk_7830319')->references('id')->on('service_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7974066')->references('id')->on('members');
        });
    }
}
