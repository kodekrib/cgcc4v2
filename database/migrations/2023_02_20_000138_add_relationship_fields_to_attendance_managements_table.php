<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAttendanceManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('attendance_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_type_id')->nullable();
            $table->foreign('meeting_type_id', 'meeting_type_fk_7951180')->references('id')->on('meeting_types');
            $table->unsignedBigInteger('meeting_title_id')->nullable();
            $table->foreign('meeting_title_id', 'meeting_title_fk_7812649')->references('id')->on('meetings');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7973571')->references('id')->on('members');
            $table->unsignedBigInteger('cih_centre_id')->nullable();
            $table->foreign('cih_centre_id', 'cih_centre_fk_7974247')->references('id')->on('cihzones');
        });
    }
}
