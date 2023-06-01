<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMeetingsTable extends Migration
{
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_type_id')->nullable();
            $table->foreign('meeting_type_id', 'meeting_type_fk_7951176')->references('id')->on('meeting_types');
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->foreign('venue_id', 'venue_fk_7684506')->references('id')->on('venues');
            // $table->unsignedBigInteger('attendees_id')->nullable();
            // $table->foreign('attendees_id', 'attendees_fk_8035642')->references('id')->on('members');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7684513')->references('id')->on('users');
        });
    }
}
