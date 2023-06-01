<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubSectorsTable extends Migration
{
    public function up()
    {
        Schema::table('sub_sectors', function (Blueprint $table) {
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id', 'industry_fk_7962056')->references('id')->on('industry_sectors');
        });
    }
}
