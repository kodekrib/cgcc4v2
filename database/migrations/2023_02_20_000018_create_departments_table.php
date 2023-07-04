<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dept_code');
            $table->string('department_name');
            $table->string('department_email')->unique();
            $table->boolean('inactive')->default(0)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('pending')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
