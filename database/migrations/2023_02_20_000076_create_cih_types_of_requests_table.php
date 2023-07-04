<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihTypesOfRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('cih_types_of_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('types_of_request')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
