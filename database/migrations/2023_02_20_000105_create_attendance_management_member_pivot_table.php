<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceManagementMemberPivotTable extends Migration
{
    public function up()
    {
        Schema::create('attendance_management_member', function (Blueprint $table) {
            $table->unsignedBigInteger('attendance_management_id');
            $table->foreign('attendance_management_id', 'attendance_management_id_fk_7973570')->references('id')->on('attendance_managements')->onDelete('cascade');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id', 'member_id_fk_7973570')->references('id')->on('members')->onDelete('cascade');
        });
    }
}
