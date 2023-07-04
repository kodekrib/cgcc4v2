<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_type')->nullable();
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
