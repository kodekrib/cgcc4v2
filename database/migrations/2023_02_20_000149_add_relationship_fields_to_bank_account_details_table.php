<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankAccountDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('bank_account_details', function (Blueprint $table) {
            $table->unsignedBigInteger('account_type_id')->nullable();
            $table->foreign('account_type_id', 'account_type_fk_7976554')->references('id')->on('bank_account_types');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_7976644')->references('id')->on('currencies');
        });
    }
}
