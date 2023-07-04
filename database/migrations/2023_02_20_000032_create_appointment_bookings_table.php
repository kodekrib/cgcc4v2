<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_name')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->longText('purpose');
            $table->boolean('re_assigned')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
