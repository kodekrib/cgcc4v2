<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlutterwaveApikeysTable extends Migration
{
    public function up()
    {
        Schema::create('flutterwave_apikeys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('public_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('encryption_key')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
