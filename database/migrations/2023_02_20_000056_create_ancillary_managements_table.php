<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAncillaryManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('ancillary_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->longText('service_description')->nullable();
            $table->boolean('approve')->default(0)->nullable();
            $table->boolean('decline')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
