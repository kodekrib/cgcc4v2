<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountTypesTable extends Migration
{
    public function up()
    {
        Schema::create('bank_account_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
