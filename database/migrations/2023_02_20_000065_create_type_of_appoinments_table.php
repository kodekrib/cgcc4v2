<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfAppoinmentsTable extends Migration
{
    public function up()
    {
        Schema::create('type_of_appoinments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
