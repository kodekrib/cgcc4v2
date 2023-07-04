<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOutreachesTable extends Migration
{
    public function up()
    {
        Schema::table('outreaches', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_7807194')->references('id')->on('outreach_types');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_7807181')->references('id')->on('locations');
            $table->unsignedBigInteger('contact_person_id')->nullable();
            $table->foreign('contact_person_id', 'contact_person_fk_7807182')->references('id')->on('users');
        });
    }
}
