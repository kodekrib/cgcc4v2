<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseMemberPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_member', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_8014096')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id', 'member_id_fk_8014096')->references('id')->on('members')->onDelete('cascade');
        });
    }
}
