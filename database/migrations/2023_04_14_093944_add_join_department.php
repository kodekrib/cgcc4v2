<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJoinDepartment extends Migration
{

    public function up()
    {
        Schema::table('join_departments', function (Blueprint $table) {
            $table->integer('approval_status')->default(0);
            $table->integer('status')->default(1);

        });
    }


    public function down()
    {
        Schema::table('join_departments', function (Blueprint $table) {
            $table->dropColumn('is_approved');
            $table->dropColumn('is_pending');
            $table->dropColumn('disapproved');
            $table->dropColumn('delisted');
         });
    }
}
