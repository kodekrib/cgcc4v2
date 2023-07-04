<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttendanceManagementTime extends Migration
{

    public function up()
    {
        Schema::table('attendance_managements', function (Blueprint $table) {
            $table->string('timeData')-> nullable();
        });
    }


    public function down()
    {
        //
    }
}
