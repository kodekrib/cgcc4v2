<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('employment_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employment_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
