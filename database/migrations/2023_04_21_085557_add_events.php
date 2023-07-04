<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEvents extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {

            $table->integer('status')->default(0);
        });
    }


    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('inactive');
            $table->dropColumn('cancelled');

         });
    }
}
