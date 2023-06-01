<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeetingChange extends Migration
{

    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->json('date_of_meeting')->change();
            $table->string('selected_groups');
            $table->integer('department_id')->nullable();
            $table->string('affinity_group')->nullable();
            $table->integer('re_occurence')->default(0);
            $table->integer('approval_status')->default(0);
            $table->json('re_occurence_json')->nullable();
            $table->string('start_time')->nullable();
            $table->json('attendees_id_list')->nullable();
        });
    }


    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn('processing');
            $table->dropColumn('disapproved');
            $table->dropColumn('approved');
            $table->dropColumn('attendees_id');
            $table->dropForeign('attendees_fk_8035642');

         });
    }
}
