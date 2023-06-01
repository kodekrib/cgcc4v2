<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('cih_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_of_request')->nullable();
            $table->date('date_of_request_event')->nullable();
            $table->boolean('approve')->default(0)->nullable();
            $table->boolean('decline')->default(0)->nullable();
            $table->boolean('pending')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
