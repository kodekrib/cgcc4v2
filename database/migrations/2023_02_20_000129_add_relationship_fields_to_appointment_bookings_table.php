<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('appointment_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_type_id')->nullable();
            $table->foreign('appointment_type_id', 'appointment_type_fk_7951179')->references('id')->on('type_of_appoinments');
            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_7962244')->references('id')->on('members');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7684825')->references('id')->on('users');
        });
    }
}
