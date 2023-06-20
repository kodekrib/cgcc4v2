<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('join_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_type')->nullable();
            $table->string('primary_function')->nullable();
            // $table->boolean('is_approved')->default(0)->nullable();
            // $table->boolean('is_pending')->default(0)->nullable();
            // $table->boolean('disapproved')->default(0)->nullable();
            // $table->boolean('delisted')->default(0)->nullable();
            $table->longText('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
