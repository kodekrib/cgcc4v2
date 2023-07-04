<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTypePivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_type_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_type_id');
            $table->foreign('appointment_type_id', 'appointment_type_id_fk_7900570')->references('id')->on('type_of_appoinments')->onDelete('cascade');
            $table->unsignedBigInteger('appointment_type_member_id');
            $table->foreign('appointment_type_member_id', 'appointment_type_member_id_fk_7900570')->references('id')->on('members')->onDelete('cascade');

        });

        Schema::table('type_of_appoinments', function (Blueprint $table) {

            $table->unsignedBigInteger('default_members_id')->nullable();
            $table->foreign('default_members_id', 'default_members_id_fk_80357898770')->references('id')->on('members');
        });

    }

    public function down()
    {
        Schema::dropIfExists('appointment_type_pivot');
    }
}
