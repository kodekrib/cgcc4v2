<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingTemplatesTable extends Migration
{
       public function up()
    {
        Schema::create('mailing_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mailing_operation_code');
            $table->text('template');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('mailing_templates');
    }
}
