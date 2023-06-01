<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('issue_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('issue_title')->nullable();
            $table->longText('issue_description')->nullable();
            $table->boolean('open')->default(0)->nullable();
            $table->boolean('work_in_progress')->default(0)->nullable();
            $table->boolean('closed')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
