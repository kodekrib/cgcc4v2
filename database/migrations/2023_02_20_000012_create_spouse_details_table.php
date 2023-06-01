<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpouseDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('spouse_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('last_name');
            $table->string('first_name')->nullable();
            $table->string('maiden_name')->nullable();
            $table->string('relationship');
            $table->date('date_of_birth');
            $table->date('wedding_anniv');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
