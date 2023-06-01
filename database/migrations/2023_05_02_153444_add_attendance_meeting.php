<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttendanceMeeting extends Migration
{

    public function up()
    {
        Schema::table('attendance_managements', function (Blueprint $table) {
            $table->json('members_in_attendancesL')-> nullable();
            $table->json('members_in_absence')-> nullable();
            $table->json('members_in_excuse')-> nullable();
            $table->string('dateData')-> nullable();
        });
    }


    public function down()
    {
        Schema::table('attendance_managements', function (Blueprint $table) {
            $table->dropColumn('present');
            $table->dropColumn('absent');
            $table->dropColumn('excused');
            $table->dropColumn('date');

         });
    }
}
