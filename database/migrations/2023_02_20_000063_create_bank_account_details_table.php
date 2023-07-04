<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
