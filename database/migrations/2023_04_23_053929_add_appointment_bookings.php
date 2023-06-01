<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointmentBookings extends Migration
{

    public function up()
    {
        Schema::table('appointment_bookings', function (Blueprint $table) {
            $table->boolean('approved_status')->default(0);
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('approved');
            $table->dropColumn('disapproved');
            $table->dropColumn('opened');
            $table->dropColumn('in_progress');

         });
    }
}
